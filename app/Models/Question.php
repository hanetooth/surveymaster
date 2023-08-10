<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'text',
        'hint',
        'component_id',
        'is_required',
        'form_id',
        'form_version',
    ];

    protected $appends = [
        'input_name',
    ];

    /**
     * Get the associated component of the question.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function component(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Component::class);
    }

    /**
     * Get the associated form of the question.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Form::class)
                    ->where('version', $this->form_version);
    }

    /**
     * input element name of the question.
     * @return Attribute
     * @example "What is your name?" => "What_is_your_name?"
     */
    protected function inputName(): Attribute
    {
        return Attribute::make(
            get: fn () => str_replace(' ', '_', $this->text),
        )->shouldCache();
    }
}
