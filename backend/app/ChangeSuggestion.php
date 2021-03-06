<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\ChangeSuggestion
 *
 * @property int $id
 * @property string $channel_id
 * @property string|null $tier
 * @property bool|null $good_editor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ChangeSuggestion newModelQuery()
 * @method static Builder|ChangeSuggestion newQuery()
 * @method static Builder|ChangeSuggestion query()
 * @method static Builder|ChangeSuggestion whereChannelId($value)
 * @method static Builder|ChangeSuggestion whereCreatedAt($value)
 * @method static Builder|ChangeSuggestion whereGoodEditor($value)
 * @method static Builder|ChangeSuggestion whereId($value)
 * @method static Builder|ChangeSuggestion whereTier($value)
 * @method static Builder|ChangeSuggestion whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ChangeSuggestion extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'good_editor' => 'bool',
    ];

    public function mainFocus()
    {
        return $this->morphTo();
    }
}
