<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItemOption extends Model
{
    protected $table = "cart_item_options";

    protected $fillable = [
        "cart_item_id",
        "product_option_id",
        "price_snapshot",
    ];

    public function cartItem(): BelongsTo
    {
        return $this->belongsTo(CartItem::class);
    }

    public function productOption(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }
}
