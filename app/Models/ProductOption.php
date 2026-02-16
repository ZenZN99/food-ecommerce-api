<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $table = "product_options";

    protected $fillable = [
        "product_id",
        "name",
        "price",
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cartItemOptions()
    {
        return $this->hasMany(CartItemOption::class);
    }
}
