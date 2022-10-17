<?php

use Illuminate\Database\Seeder;

use App\Tag;

use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [ 'HTML', 'CSS', 'SASS', 'JS', 'PHP', 'MySQL', 'Tailwind', 'Bootstrap', 'Angular', 'VueJs', 'React', 'Laravel', 'Wordpress'];

        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag);
            $newTag->save();
        }
    }
}
