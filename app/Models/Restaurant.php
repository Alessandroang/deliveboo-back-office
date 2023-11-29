<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;


class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'image', 'description', 'phone', 'user_id', 'type_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function plates()
    {
        return $this->hasMany(Plate::class);
    }

    public function getAbsUriImage()
    {
        return $this->image ? Storage::url($this->image) : null;
    }
}