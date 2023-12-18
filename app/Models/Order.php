<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'address',
        'email',
        'phone',
        'total_orders',
        //'cart',
    ];

    public function plates()
    {
        return $this->belongsToMany(Plate::class)->withTimestamps();
    }
}