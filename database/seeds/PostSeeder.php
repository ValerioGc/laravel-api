<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Post;
use App\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('it_IT');


        for ($i = 0; $i < 50; $i++) {
            $fakerPost = new Post();
            $fakerPost->title = $faker->words(4, true);
            $fakerPost->slug = preg_replace('/\s+/', '-', $fakerPost->title);
            $fakerPost->category_id = $faker->numberBetween(1, 7);
            $fakerPost->content = $faker->text($minNbChars = 200, $maxNbChars = 300);
            $fakerPost->save();
        }
    }
}
