<?php

namespace App\Domains\Custom\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public const PENDING = 1;
    public const PAID = 2;
    public const FAILED = 3;

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

}
