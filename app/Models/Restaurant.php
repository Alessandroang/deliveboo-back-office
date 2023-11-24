<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'image', 'description', 'phone', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
