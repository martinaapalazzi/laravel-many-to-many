<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content'
    ];

    /*
        Relationships
    */
    public function type()
    {
        return $this->belongsTo(Type::class); // un Post ha solo un Type
        // funzione che indentifica la relazione one-to-many
        // e Post è la taballa dipendente
        // in cui Type è la tabella indipendente
    }
}
