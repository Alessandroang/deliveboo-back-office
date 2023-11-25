<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    #Opzionali
    protected $fillable = ['label', 'color'];

    protected $hidden = ['pivot'];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
    #Opzionali
    public function getTypeBadge()
    {
        return $this->label ? "<span class='badge' style='background-color: {$this->color}'>{$this->label}</span>" : 'Nessuna tipologia specificata';
    }
}
