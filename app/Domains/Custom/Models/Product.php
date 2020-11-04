<?php

namespace App\Domains\Custom\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $hidden = [ 'created_at', 'updated_at'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
