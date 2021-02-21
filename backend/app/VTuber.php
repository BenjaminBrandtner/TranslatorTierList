<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\VTuber
 *
 * @property int $id
 * @property string $name
 * @property string $focus_name
 * @property int|null $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Category|null $category
 * @method static Builder|VTuber newModelQuery()
 * @method static Builder|VTuber newQuery()
 * @method static Builder|VTuber query()
 * @method static Builder|VTuber whereCategoryId($value)
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
