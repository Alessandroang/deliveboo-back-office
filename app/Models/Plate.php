<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Plate extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'ingredients', 'description', 'image', 'price'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }


    public function getAbstract($chars = 150)
    {
        return strlen($this->description) > $chars ? substr($this->description, 0, $chars) . '...' : $this->description;
    }

    public function getAbsUriPlateImage()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}