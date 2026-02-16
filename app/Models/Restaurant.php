<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    protected $table = "restaurants";

    protected $fillable = [
        "user_id",
        "name",
        "description",
        "is_open",
        "delivery_fee",
        "min_order_price",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Categories::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
