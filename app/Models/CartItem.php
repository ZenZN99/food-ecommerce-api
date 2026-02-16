<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $table = "cart_items";

    protected $fillable = [
        "cart_id",
        "product_id",
        "quantity",
        "price_snapshot"
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function options()
    {
        return $this->hasMany(CartItemOption::class);
    }
}
