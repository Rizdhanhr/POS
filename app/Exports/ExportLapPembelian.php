<?php

namespace App\Exports;

// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportLapPembelian implements FromCollection, WithHeadings
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
       return DB::table('detail_pembelian')
        ->join('barang','barang.id','detail_pembelian.id_barang')
        ->whereBetween('detail_pembelian.created_at', [$this->dari, $this->sampai])
        ->get(array(
            'detail_pembelian.no_trx',
            'barang.nama as nama_barang',
            'detail_pembelian.jumlah',
            'detail_pembelian.harga',
            'detail_pembelian.subtotal'
        ));
    }

    // public function map($registration) : array {
    //     return [
    //         $registration->id,
    //         $registration->user->email,
    //         $registration->user->key_num,
    //         $registration->user->plus_one,
    //         Carbon::parse($registration->event_date)->toFormattedDateString(),
    //         Carbon::parse($registration->created_at)->toFormattedDateString()
    //     ] ;


    // }

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
