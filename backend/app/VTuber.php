<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\VTuber
 *
 * @property int $id
 * @property string $name
 * @property string $focus_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\TranslationChannel[] $focusedOnByComputed
 * @property-read int|null $focused_on_by_computed_count
 * @property-read Collection|\App\TranslationChannel[] $focusedOnByManual
 * @property-read int|null $focused_on_by_manual_count
 * @method static Builder|VTuber newModelQuery()
 * @method static Builder|VTuber newQuery()
 * @method static Builder|VTuber query()
 * @method static Builder|VTuber whereCreatedAt($value)
 * @method static Builder|VTuber whereFocusName($value)
 * @method static Builder|VTuber whereId($value)
 * @method static Builder|VTuber whereName($value)
 * @method static Builder|VTuber whereUpdatedAt($value)
 * @mixin Eloquent
 */
class VTuber extends Model
{
    protected $guarded = [];
    protected $casts = [
        'keywords' => 'array',
    ];

    public function focusedOnByManual()
    {
        return $this->hasMany(TranslationChannel::class, 'main_focus_manual');
    }

    public function focusedOnByComputed()
    {
        return $this->hasMany(TranslationChannel::class, 'main_focus_computed');
    }
}
