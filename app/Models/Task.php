<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Task extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'user_id'];
    public $translatable = ['name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
