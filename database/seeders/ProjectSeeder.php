<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Project;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            $project = new Project;
            $project->title = $faker->firstNameMale();
            $project->description = $faker->paragraph(8);
            $project->image = "https://picsum.photos/300/200";
            $project->save();
        }
    }
}