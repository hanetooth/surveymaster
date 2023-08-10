<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answers';

    protected $fillable = [
        'text',
        'question_id',
        'submission_id',
    ];

    /**
     * Get the associated question of the answer.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the associated submission of the answer.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submission(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }
}
