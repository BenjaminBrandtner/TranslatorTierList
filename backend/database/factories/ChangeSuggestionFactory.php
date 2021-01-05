<?php

namespace Database\Factories;

use App\ChangeSuggestion;
use App\TranslationChannel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChangeSuggestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChangeSuggestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'channel_id' => $this->faker->md5,
            'tier' => TranslationChannel::$possibleTiers[$this->faker->numberBetween(0, 3)],
            'good_editor' => $this->faker->boolean(30),
        ];
    }
}
