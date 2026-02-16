<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $table = "addresses";

    protected $fillable = [
        "user_id",
        "city",
        "street",
        "notes",
        "lat",
        "lng",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
