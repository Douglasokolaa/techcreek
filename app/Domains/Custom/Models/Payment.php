<?php

namespace App\Domains\Custom\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Payment extends Model
{
    use HasFactory, Searchable;

    public const PENDING = 1;
    public const PAID = 2;
    public const FAILED = 3;

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
        // return [
        //     'reference' => $array['reference'],
        //     'name'      => $array['name'],
        //     'id'        => $array['id'],
        //     'status'    => $array['status'] ? 'Paid': 'Pending',
        //     'programme' => $this->product->name,
        // ];
    }

}
