<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customerDetails()
    {
        return $this->belongsTo(Coustomer::class, 'customer_id');
    }
}
