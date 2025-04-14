<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Font;
use App\Models\Sale;

class SalesExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles
{
    public function collection()
    {
        return Sale::all();
    }
    public function title(): string
    {
        return 'Laporan Penjualan Toko Syams';
    }

    public function styles($sheet)
    {
        $sheet->getCell('A1')->getStyle()->getFont()->setBold(true)->setSize(18);
    }

    public function headings(): array
{
    return [
        ['Laporan Penjualan Toko Syams'],
        [
            'No',
            'Nomor Invoice',
            'Nama Pelanggan',
            'Tanggal Penjualan',
            'Produk',
            'Jumlah',
            'Subtotal',
            'Total Harga',
            'Total Bayar',
            'Kembalian',
            'Dibuat Oleh'
        ]
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

    $rows = [];
    $rows[] = [
        $id,
        $sale->invoice_number,
        $sale->customer_name,
        $sale->created_at->format('d-m-Y H:i'),
        '',
        '',
        '',
        str_replace(',', '', str_replace('.', '', number_format($sale->total_amount, 0, ',', '.'))),
        str_replace(',', '', str_replace('.', '', number_format($sale->payment_amount, 0, ',', '.'))),
        str_replace(',', '', str_replace('.', '', number_format($sale->change_amount, 0, ',', '.'))),
        DB::table('users')->where('id', $sale->user_id)->value('name'),
    ];

    foreach ($products as $product) {
        $rows[] = [
            '',
            '',
            '',
            '',
            $product['name'],
            $product['quantity'],
            str_replace(',', '', str_replace('.', '', number_format($product['subtotal'], 0, ',', '.'))),
            '',
            '',
        ];
    }

    return $rows;
}
}