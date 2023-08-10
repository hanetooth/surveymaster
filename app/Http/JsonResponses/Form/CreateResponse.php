<?php

namespace App\Http\JsonResponses\Form;

use App\Models\Form;
use Illuminate\Http\JsonResponse;

class CreateResponse extends JsonResponse
{
    /**
     * CreateResponse constructor.
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        parent::__construct([
            'success' => true,
            'form' => $form,
            'form_url' => route('form.show', ['hashId' => $form->hashId]),
        ]);
    }
}
