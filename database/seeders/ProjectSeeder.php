<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 20; $i++){

            $new_project = new Project();
            $new_project->user_id = User::inRandomOrder()->first()->id;
            $new_project->name = $faker->sentence(3);
            $new_project->slug = Project::generateSlug($new_project->name);
            $new_project->client_name = $faker->name;

            $new_project->summary = $faker->paragraph(2);

            $new_project->save();
        }
    }
}
