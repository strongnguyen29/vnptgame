<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Recruitment;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecruitmentFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recruitment::class;

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
            'language' => Arr::random(['vi', 'en']),
            'deadline' => Carbon::now()->addDays(random_int(3,30))->format('Y-m-d')
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Recruitment $recruitment) {
            $catIds = Category::type(Category::TYPE_RECRUIT)->get('id')->pluck('id');

            $recruitment->categories()->attach($catIds->random());

            $recruitment->addMediaFromUrl(asset('images/img2.jpg'))
                        ->setFileName($recruitment->slug . '.jpg')
                        ->toMediaCollection(Recruitment::MEDIA_COLLECT);
        });
    }
}
