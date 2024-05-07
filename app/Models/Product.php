<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'producer',
        'product_id',
        'actual',
        'price_unit',
        'weight',
        'diameter',
        'length',
        'width',
        'height',
        'thickness',
        'packaging_type',
        'purchase_units',
        'unit_name',   
    ];

    public static function search($searchQuery, $manufacturer)
    {
        return self::query()
            ->when($searchQuery, function ($query) use ($searchQuery) {
                return $query->where('name', 'like', '%' . $searchQuery . '%');
            })
            ->when($manufacturer, function ($query) use ($manufacturer) {
                return $query->where('producer', $manufacturer);
            })
            ->get();
    }
}
