<?php

namespace App\Exports;

use App\TransactionModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;


class TransaksiExport implements FromCollection,WithHeadings
{
    public function __construct(string $storeId){
        $this->storeId = $storeId;
    }
    public function collection()
    {
        $sql = TransactionModel::where('store_id', $this->storeId)
        ->select(
            'transaction.visitor_name',
            'transaction.product_name',
            'transaction.product_price',
            'transaction.address_customer',
            'transaction.description',
            'transaction.status',
        )->get();
        return $sql;
        
    }
    public function headings(): array
    {
        return [
            'PEMBELI',
            'PRODUK',
            'HARGA PRODUK',
            'ALAMAT',
            'DESKRIPSI',
            'STATUS',
        ];
    }
}
