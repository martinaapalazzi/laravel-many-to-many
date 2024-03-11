<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Post;
use App\Models\Technology;

class PostTechnologyRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $technologies = Technology::inRandomOrder()->get();
            
            $counter = 0;
            $maxTechnologies = rand(0, 3);
            foreach ($technologies as $technology) {
                if ($counter < $maxTechnologies) {
                    $post->technologies()->attach($technology->id);
                    $counter++;
                }
                else {
                    break;
                }
            }
        }
    }
    
}
