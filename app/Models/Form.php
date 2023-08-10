<?php

namespace App\Models;

use Deligoez\LaravelModelHashId\Traits\HasHashId;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasHashId;

    protected $table = 'forms';

    protected $fillable = [
        'title', 'description', 'owner_id', 'is_published', 'version',
    ];

    /**
     * Get the owner (user) of the project.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the associated questions of the form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get the associated submissions of the form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Submission::class);
    }
}
