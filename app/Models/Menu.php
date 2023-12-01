<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SolutionForest\FilamentTree\Concern\ModelTree;
use Spatie\Translatable\HasTranslations;
use Z3d0X\FilamentFabricator\Models\Page;

class Menu extends Model
{
    use ModelTree, HasTranslations;

    public $translatable = ['title'];
    protected $fillable = ['key', 'title', 'redirect', 'target', 'visible', 'image_id', 'page_id', 'parent_id', 'order'];
    protected $table = 'menu';


    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id', 'id');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }
}
