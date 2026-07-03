<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'event_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'quantity',
        'total_price',
        'status',
        'snap_token'
    ];

    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}