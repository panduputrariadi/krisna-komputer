<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cashier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complain extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'productComplain',
        'kontenKomplain',
        'adminKomplain'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'customer', 'id');
    }

    public function cashier(){
        return $this->belongsTo(Cashier::class, 'productComplain', 'id');
    }
}
