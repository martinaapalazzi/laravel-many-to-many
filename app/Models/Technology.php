<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
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
        return $this->belongsToMany(Post::class); // le Technology hanno più Posts, Posts ha più Technology
        // funzione che indentifica la relazione many-to-many 
    }

}
