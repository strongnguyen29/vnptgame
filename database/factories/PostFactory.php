<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(8);

        return [
            'user_id' => 1,
            'title' => $title,
            'slug'  => Str::slug($title),
            'desc' => $this->faker->paragraph(3),
            'content' => $this->faker->paragraph(5),
            'active' => true,
            'meta_title' =>$title,
            'meta_desc' => $this->faker->paragraph(2),
            'tags' => ['tư vấn', 'thiết kế', 'tin tức', 'nhà đẹp'],
            'language' => Arr::random(['vi', 'en'])
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $catIds = Category::type(Category::TYPE_POST)->get('id')->pluck('id');

            $post->categories()->attach($catIds->random());

            $post->addMediaFromUrl(asset('images/img1.jpg'))
                        ->setFileName($post->slug . '.jpg')
                        ->toMediaCollection(Post::MEDIA_COLLECT);
        });
    }
}
