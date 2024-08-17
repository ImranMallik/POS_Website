<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'product_name'   => $row[1],
            'category_id'    => $row[2], // Ensure this is an integer and valid category ID
            'supplier_id'    => $row[3],
            'product_code'   => $row[4],
            'product_garage' => $row[5],
            'product_image'  => $row[6],
            'product_store'  => $row[7],
            'buying_date'    => $row[8],
            'expire_date'    => $row[9],
            'buying_price'   => $row[10],
            'selling_price'  => $row[11],
        ]);
    }
}
