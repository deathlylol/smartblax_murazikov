<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Product::with('category');
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->barcode,
            $product->price,
            optional($product->category)->name,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'Название товара',
            'Штрихкод',
            'Цена',
            'Название категории',
        ];
    }
}
