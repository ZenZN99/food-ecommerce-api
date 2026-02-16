<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends Model
{
    protected $table = "order_items";

    protected $fillable = [
        "order_id",
        "product_name",
        "quantity",
        "price_snapshot"
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(OrderItemOption::class);
    }
}
