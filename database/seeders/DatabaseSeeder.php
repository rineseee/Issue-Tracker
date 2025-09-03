<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Issue;
use App\Models\Tag;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(5)->create();


        Project::factory(5)->create()->each(function ($project) use ($users) {
            $issues = Issue::factory(3)->create([
                'project_id' => $project->id
            ]);

            foreach ($issues as $issue) {

                Comment::factory(2)->create([
                    'issue_id' => $issue->id
                ]);


                $issue->users()->attach($users->random(2));
            }
        });


        $tags = Tag::factory(10)->create();

        Issue::all()->each(function ($issue) use ($tags) {
            $issue->tags()->attach($tags->random(2));
        });
    }
}

