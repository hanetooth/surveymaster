<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class   Submission extends Model
{

    protected $table = 'submissions';

    protected $fillable = [
        'form_id',
        'form_version',
    ];

    /**
     * Get the associated question of the answer.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Form::class)
                    ->where('version', $this->form_version);
    }

    /**
     * Get the associated answers of the submission.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
