<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'ingredients', 'description', 'image', 'price'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getAbstract($chars = 150)
    {
        return strlen($this->description) > $chars ? substr($this->description, 0, $chars) . '...' : $this->description;
    }
}
