<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\Post;
use App\Models\Type;


//Helpers
use Nette\Schema\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Post::truncate();
        });

        for ($i = 0; $i < 10; $i++) {
            
            $title = fake()->sentence();
            $slug = Str::slug($title);
            $randomType = Type::inRandomOrder()->first();

            $post = new Post();
            $post->title = $title;
            $post->slug = $slug;
            $post->content = fake()->paragraph();
            $post->type_id = $randomType->id;
            $post->save();

            //$post = Post::create([
            //    'title' => $title,
            //    'slug' => $slug,
            //    'content' => fake()->paragraph(),
            //    'type_id' => $randomType->id,
            //]);

            // OPPURE

            //$titleForMassAssignmentFillable = fake()->sentence();
            //$slugForMassAssignmentFillable = Str::slug($titleForMassAssignmentFillable);
            //$postWithMassAssignmentFillable = Post::create([
            //    'title' => $titleForMassAssignmentFillable,
            //    'slug' => $slugForMassAssignmentFillable,
            //    'content' => fake()->paragraph(),
            //]);
        }
    }
}
