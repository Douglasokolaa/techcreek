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

    protected $fillable = [
        'name',
        'email',
        'gender',
        'plan',
        'type',
        'address',
        'phone_number',
        'duration',
        'start_date',
        'end_date',
        'amount',
        'status',
        'reference',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    public function amount()
    {
        return 'NGN' . $this->amount;
    }

    public function status(): string
    {
        switch ($this->status) {
            case SELF::PENDING:
                $status = 'Pending';
                break;
            case SELF::PAID:
                $status = 'Paid';
                break;
            case SELF::FAILED:
                $status = 'Failed';
                break;
            default:
                $status = 'UNKNOWN';
                break;
        }
        return $status;
    }

    public function period(): string
    {
        switch ($this->type) {
            case 'daily':
                $period = 'days';
                break;
            case 'monthly':
                $period = 'months';
                break;
            case 'yearly':
                $period = 'years';
                break;
            default:
                $period = $this->type;
                break;
        }
        return $this->duration . ' ' . $period;
    }

    public function Scopesearch($query, $value)
    {
        return $query->where('reference', 'like', '%' . $value . '%')
            ->OrWhere('email', 'like', '%' . $value . '%')
            ->OrWhere('name', 'like', '%' . $value . '%')
            ->OrWhere('phone_number', 'like', '%' . $value . '%')
            ->OrWhere('email', 'like', '%' . $value . '%');
    }
}
