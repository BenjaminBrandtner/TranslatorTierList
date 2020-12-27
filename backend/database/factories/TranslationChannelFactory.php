<?php

namespace Database\Factories;

use App\TranslationChannel;
use Illuminate\Database\Eloquent\Factories\Factory;

class TranslationChannelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TranslationChannel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'channel_id' => $this->faker->md5,
            'name' => $this->faker->userName,
            'profile_image_url' => $this->faker->imageUrl(88, 88),
            'profile_image_width' => 88,
            'profile_image_height' => 88,
            'channel_created_at' => $this->faker->date(),
            'subscribers_count' => $this->faker->numberBetween(0, 1000000),
            'tier' => TranslationChannel::$possibleTiers[$this->faker->numberBetween(0, 3)],
            'good_editor' => $this->faker->boolean(30),
        ];
    }

    public function uncategorized()
    {
        return $this->state(['tier' => null,]);
    }
}
