<?php

namespace App\Exports;


use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLapPenjualan implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(String $dari = null , String $sampai = null)
    {
        $this->dari = $dari;
        $this->sampai  = $sampai;
    }

    public function collection()
    {
        return DB::table('detail_penjualan')
        ->join('barang','barang.id','detail_penjualan.id_barang')
        ->whereBetween('detail_penjualan.created_at', [$this->dari, $this->sampai])
        ->get(array(
            'detail_penjualan.no_trx',
            'barang.nama as nama_barang',
            'detail_penjualan.jumlah',
            'detail_penjualan.harga',
            'detail_penjualan.subtotal'
        ));
    }

    public function headings() : array {
        return [
            'No Trx',
            'Barang',
            'Jumlah',
            'Harga',
            'Subtotal'
        ] ;
    }
}
