<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;

class ExportLapPembelian implements FromCollection
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(String $dari = null , String $sampai = null)
    {
        $this->dari = $dari;
        $this->sampai   = $sampai;
    }

    public function collection()
    {


       return DB::table('detail_pembelian')
        ->join('barang','barang.id','detail_pembelian.id_barang')
        ->whereBetween('detail_pembelian.created_at', [$this->dari, $this->sampai])
        ->get(array(
            'detail_pembelian.no_trx',
            'barang.nama as nama_barang',
            'detail_pembelian.jumlah',
            'detail_pembelian.harga',
        ));
    }
}
