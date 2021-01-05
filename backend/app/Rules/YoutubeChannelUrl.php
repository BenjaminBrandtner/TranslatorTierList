<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Validator;

class YoutubeChannelUrl implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Validator::make(
            [$attribute => $value],
            [
                $attribute => ['url', 'regex:/youtube.com\/channel\/.*/'],
            ]
        )->passes();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute needs to be a valid youtube channel url, with this format: https://www.youtube.com/channel/channelId';
    }
}
