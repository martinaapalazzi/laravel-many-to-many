<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\Type;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Type::truncate();
        });

        //OPPURE 
        //Schema::disableForeignKeyConstraints();
        //Post::truncate();
        //Schema::enableForeignKeyConstraints();

        $allTypes = [
            'HTML',
            'CSS',
            'JavaScript',
            'Vue',
            'SQL',
            'PHP',
            'Laravel'
        ];

        foreach ($allTypes as $singleType) {
            $type = Type::create([
                'title' => $singleType,
                'slug' => str()->slug($singleType),
            ]);
        }

    }
}
