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
        if (!isset($row[0])) {
            return null;
        }

        return new Product([
            'name'           => $row[1],
            'producer'       => $row[2],
            'product_id'     => $row[3],
            'actual'         => $row[4],
            'price_unit'     => $row[5],
            'weight'         => $row[6],
            'diameter'       => $row[7],
            'length'         => $row[8],
            'width'          => $row[9],
            'height'         => $row[10],
            'thickness'      => $row[11],
            'packaging_type' => $row[12],
            'purchase_units' => $row[13],
            'unit_name'      => $row[14],
        ]);
    }
}
