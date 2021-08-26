<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Object_;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(InstallSeeder::class);
        $this->createCategories();
        $this->createNews();
    }

    /**
     * Create category
     */
    protected function createCategories() {
        $cats = [
            'Tin tức' => [
                'type' => Category::TYPE_POST,
            ],
            'Tuyển dụng' => [
                'type' => Category::TYPE_RECRUIT,
            ],
        ];

        foreach ($cats as $title => $data) {
            $category = Category::query()->create([
                'parent_id' => 0,
                'type' => $data['type'],
                'title' => $title,
                'slug' => Str::slug($title),
                'desc' => $title
            ]);

            if(isset($data['subs'])) {
                foreach ($data['subs'] as $subTitle) {
                    Category::query()->create([
                        'parent_id' => $category->id,
                        'type' => $data['type'],
                        'title' => $subTitle,
                        'slug' => Str::slug($subTitle),
                        'desc' => $subTitle
                    ]);
                }
            }
        }
    }

    protected function createNews() {
        Post::factory()->count(20)->create();
    }
}

