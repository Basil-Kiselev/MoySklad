<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUpdate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function product()
    {
        $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
