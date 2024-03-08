<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug'
    ];

    /*
        Relationships
    */

    public function posts() {
        return $this->hasMany(Post::class); // i Types hanno più Posts 
        // funzione che indentifica la relazione one-to-many
        // in cui Type è la tabella indipendente
        // e Post è la taballa dipendente 
    }
}
