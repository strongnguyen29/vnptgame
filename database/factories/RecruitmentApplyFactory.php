<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Recruitment;
use App\Models\RecruitmentApply;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecruitmentApplyFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RecruitmentApply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'position' => $this->faker->sentence(2),
            'file_cv' => $this->faker->filePath()
        ];
    }
}
