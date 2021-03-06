<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Source extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'external_id', 'name'
    ];

    protected $visible = ['external_id', 'name'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'source_id', 'id');
    }
}
