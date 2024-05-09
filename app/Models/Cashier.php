<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\Complain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cashier extends Model
{
    use HasFactory;

    public const UPLOAD_YOUR_PROOF_PAYMET = 'Unggah Bukti Pembayaran';
    public const CHECKING = 'Pengecekan';
    public const COMPLETE = 'Berhasil';
    public const INVALID = 'Transaksi Invalid';

    protected $fillable = [
        'user_id',
        'product_id',
        'jumlah',
        'keterangan',
        'photo',
        'total',
        'status',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function complain(){
        return $this->belongsTo(Complain::class);
    }
}
