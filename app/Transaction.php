<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable =
    [
        'invoice', 'final_price', 'note', 'user_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_trasnaction', 'transaction_id', 'product_id');
    }
}
