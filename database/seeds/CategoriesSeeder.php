<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'News',
            'Tutorial',
            'Back-end',
            'Front-end',
            'Editing ',
            'Sicurezza',
            'BestPractices'

        ];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->title = $category;
            $newCategory->slug = Str::slug($category);
            $newCategory->save();
        }
    }

}
