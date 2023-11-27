<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    #Opzionali
    protected $fillable = ['name', 'color'];

    protected $hidden = ['pivot'];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
    #Opzionali
    public function getTypeBadge()
    {
        return $this->name ? "<span class='badge' style='background-color: {$this->color}'>{$this->name}</span>" : 'Nessuna tipologia specificata';
    }
}
