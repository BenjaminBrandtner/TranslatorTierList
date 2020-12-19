<?php


namespace App\Actions;


use App\Exceptions\ChannelDoesntExistException;
use App\Exceptions\ChannelExistsException;
use App\Exceptions\InvalidTierException;
use App\Exceptions\InvalidUrlException;
use App\Http\Clients\Youtube\YoutubeClient;
use App\TranslationChannel;
use Str;

class AddTranslationChannel
{
    /**
     * @param string $url A youtube channel url or video url
     * @param string|null $tier
     * @param bool|null $goodEditor
     * @param bool $force Overwrite the info in the database
     * @throws ChannelDoesntExistException
     * @throws ChannelExistsException
     * @throws InvalidTierException
     * @throws InvalidUrlException
     *
     * Add a Translationchannel to the database, after checking it exists on Youtube. Designed to be used from console, perhaps from Nova.
     */
    public static function run(string $url, ?string $tier, ?bool $goodEditor, bool $force = false)
    {
        if ($tier) {
            $tier = Str::upper($tier);

            if (array_search($tier, TranslationChannel::$possibleTiers) === false) {
                throw new InvalidTierException(
                    sprintf(
                        'Tier must be one of: [%s]. %s given.',
                        collect(TranslationChannel::$possibleTiers)->join(', '),
                        $tier
                    )
                );
            }
        }

        $channelId = self::getChannelId($url);

        if (TranslationChannel::whereChannelId($channelId)->exists()) {
            $channel = TranslationChannel::whereChannelId($channelId)->first();

            if (!$force) {
                throw new ChannelExistsException(
                    'This channel already exists. It currently has the tier '
                    . $channel->tier . ' and editor status ' . $channel->good_editor . '.'
                );
            }

            $channel->tier = $tier;
            $channel->good_editor = $goodEditor;
            $channel->save();

            return;
        }

        $channel = (new YoutubeClient())->getChannels([$channelId])->first();

        if (is_null($channel)) {
            throw new ChannelDoesntExistException('Can\'t find a youtube channel with the id ' . $channelId);
        }

        TranslationChannel::createFromYoutubeChannel($channel, $tier, $goodEditor);
    }

    private static function getChannelId(string $url): string
    {
        $urlSegments = collect(explode('/', $url));
        $channelId = '';

        if (Str::of($urlSegments->last())->startsWith('watch')) {
            parse_str($urlSegments->last(), $parameters);
            $channelId = (new YoutubeClient())->getChannelIdFromVideoId($parameters['watch?v']);
        } elseif ($urlSegments->contains('youtu.be')) {
            $youtubeIndex = $urlSegments->takeUntil(fn($s) => $s === 'youtu.be')->count();
            $channelId = (new YoutubeClient())->getChannelIdFromVideoId($urlSegments[$youtubeIndex + 1]);
        } elseif ($urlSegments->contains('channel')) {
            $channelIndex = $urlSegments->takeUntil(fn($s) => $s === 'channel')->count();
            $channelId = $urlSegments[$channelIndex + 1];
        }

        if (empty($channelId)) {
            throw new InvalidUrlException(
                'Please provide a valid url, like https://www.youtube.com/channel/channelId, https://youtu.be/videoId, or https://www.youtube.com/watch?v=videoId'
            );
        }

        return $channelId;
    }
}
