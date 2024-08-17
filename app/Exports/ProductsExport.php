<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::select(
            'products.product_name',
            'categories.category_name as category_name',
            'suppliers.name as supplier_name',
            'products.product_code',
            'products.product_garage',
            'products.product_image',
            'products.product_store',
            'products.expire_date',
            'products.buying_price',
            'products.selling_price'
        )
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->get();
    }
}
