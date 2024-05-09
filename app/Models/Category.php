<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,HasUlids;

    protected $fillable = [
        'kategori'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'categories_id', 'id');
    }

}
