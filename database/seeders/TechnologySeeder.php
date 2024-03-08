<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\Technology;

// Helpers
use Illuminate\Support\Facades\Schema;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Technology::truncate();
        });

        $allTechnologys = [
            'News',
            'Updates',
            'Release',
            'Technology',
            'Web',
            'Software',
            'Hardware',
            'Blockchain',
            'AI',
            'Machine Learning',
            'ChatGPT',
        ];

        foreach ($allTechnologys as $singleTech) {
            $tech = Technology::create([
                'title' => $singleTech,
                'slug' => str()->slug($singleTech),
            ]);
        }
    }  
}
