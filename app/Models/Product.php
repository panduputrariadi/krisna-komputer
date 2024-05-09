<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SeriesProduct;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'nama',
        'series_products_id',
        'categories_id',
        'harga',
        'stok',
    ];

    public function seriesproduct()
    {
        return $this->belongsTo(SeriesProduct::class, 'series_products_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function photo()
    {
        return $this->hasMany(Photo::class, 'product_id', 'id');
    }
}
