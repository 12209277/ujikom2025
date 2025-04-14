<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Sheet;
use App\Models\Sale;

class SalesExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    public function collection()
    {
        return Sale::all();
    }
    public function title(): string
    {
        return 'Laporan Penjualan Toko Syams';
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor Invoice',
            'Nama Pelanggan',
            'Tanggal Penjualan',
            'Produk',
            'Total Harga',
            'Total Bayar',
            'Kembalian',
            'Dibuat Oleh'
        ];
    }

    private static $counter = 1;

    public function map($sale): array
    {
        $id = self::$counter++;

        $productData = is_string($sale->product_data) ? json_decode($sale->product_data, true) : $sale->product_data;

        if (!is_array($productData)) {
            $productData = [];
        }

        $productDataEncoded = json_encode($productData);
        $products = json_decode($productDataEncoded, true);

        $prettyProducts = 'Product | Quantity | Subtotal |' . "\n";
        foreach ($products as $product) {
            $prettyProducts .= $product['name'] . ' | ' . $product['quantity'] . ' | ' . str_replace(',', '', str_replace('.', '', number_format($product['subtotal'], 0, ',', '.'))) . ' | ' . "\n";
        }

        return [
            $id,
            $sale->invoice_number,
            $sale->customer_name,
            $sale->created_at->format('d-m-Y H:i'),
            $prettyProducts,
            str_replace(',', '', str_replace('.', '', number_format($sale->total_amount, 0, ',', '.'))),
            str_replace(',', '', str_replace('.', '', number_format($sale->payment_amount, 0, ',', '.'))),
            str_replace(',', '', str_replace('.', '', number_format($sale->change_amount, 0, ',', '.'))),
            DB::table('users')->where('id', $sale->user_id)->value('name'),
        ];
    }
}