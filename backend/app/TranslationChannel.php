<?php

namespace App;

use App\Http\Clients\Youtube\YoutubeChannel;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\TranslationChannel
 *
 * @property int $id
 * @property string $channel_id
 * @property string|null $name
 * @property string|null $profile_image_url
 * @property string|null $profile_image_width
 * @property string|null $profile_image_height
 * @property Carbon|null $channel_created_at
 * @property int|null $subscribers_count
 * @property string|null $tier
 * @property bool|null $good_editor
 * @property string|null $main_focus_manual
 * @property int|null $main_focus_computed
 * @property int|null $main_focus_computed_accuracy
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\ChangeSuggestion[] $changeSuggestions
 * @property-read int|null $change_suggestions_count
 * @property-read string $url
 * @property-read \App\VTuber|null $mainFocusComputed
 * @property-read \App\VTuber|null $mainFocusManual
 * @method static Builder|TranslationChannel newModelQuery()
 * @method static Builder|TranslationChannel newQuery()
 * @method static Builder|TranslationChannel query()
 * @method static Builder|TranslationChannel whereChannelCreatedAt($value)
 * @method static Builder|TranslationChannel whereChannelId($value)
 * @method static Builder|TranslationChannel whereCreatedAt($value)
 * @method static Builder|TranslationChannel whereGoodEditor($value)
 * @method static Builder|TranslationChannel whereId($value)
 * @method static Builder|TranslationChannel whereMainFocusComputed($value)
 * @method static Builder|TranslationChannel whereMainFocusComputedAccuracy($value)
 * @method static Builder|TranslationChannel whereMainFocusManual($value)
 * @method static Builder|TranslationChannel whereName($value)
 * @method static Builder|TranslationChannel whereProfileImageHeight($value)
 * @method static Builder|TranslationChannel whereProfileImageUrl($value)
 * @method static Builder|TranslationChannel whereProfileImageWidth($value)
 * @method static Builder|TranslationChannel whereSubscribersCount($value)
 * @method static Builder|TranslationChannel whereTier($value)
 * @method static Builder|TranslationChannel whereUpdatedAt($value)
 * @mixin Eloquent
 */
class TranslationChannel extends Model
{
    public static array $possibleTiers = ['S', 'A', 'B', 'C', 'U'];
    protected $guarded = [];
    protected $casts = [
        'channel_created_at' => 'date',
        'good_editor' => 'bool',
    ];

    public function mainFocusManual()
    {
        return $this->belongsTo(VTuber::class, 'main_focus_manual');
    }

    public function mainFocusComputed()
    {
        return $this->belongsTo(VTuber::class, 'main_focus_computed');
    }

    public function changeSuggestions()
    {
        return $this->hasMany(ChangeSuggestion::class);
    }

    public function getUrlAttribute(): string
    {
        return YoutubeChannel::$baseUrl . $this->channel_id;
    }

    public static function createFromYoutubeChannel(YoutubeChannel $youtubeChannel, ?string $tier, ?bool $goodEditor)
    {
        TranslationChannel::create(
            [
                'name' => $youtubeChannel->name,
                'channel_id' => $youtubeChannel->channelId,
                'profile_image_url' => $youtubeChannel->logo->url,
                'profile_image_width' => $youtubeChannel->logo->width,
                'profile_image_height' => $youtubeChannel->logo->height,
                'channel_created_at' => $youtubeChannel->channel_created_at,
                'subscribers_count' => $youtubeChannel->subscribersCount,
                'tier' => $tier,
                'good_editor' => $goodEditor,
            ]
        );
    }
}
