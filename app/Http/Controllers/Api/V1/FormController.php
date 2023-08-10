<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\FailedToBuildFormException;
use App\Http\Controllers\Controller;
use App\Http\JsonResponses\Form\CreateResponse;
use App\Http\Requests\Api\Form\CreateRequest;
use App\Models\Form;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * @group FormCRUD
 *
 * CRUD Api for Form
 */
class FormController extends Controller
{

    /**
     * Create a new form
     *
     * @param CreateRequest $request
     * @return CreateResponse
     * @throws FailedToBuildFormException
     */
    public function create(CreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $form = Form::create([
                'title' => $request->title,
                'description' => $request->description,
                'owner_id' => auth()->user()->id,
                'is_published' => true,
                'version' => 1,
            ]);
            foreach ($request->questions as $question) {
                $form->questions()->create([
                    'text' => $question['text'],
                    'hint' => $question['hint'] ?? null,
                    'is_required' => $question['is_required'],
                    'component_id' => $question['component_id'],
                    'form_version' => $form->version,
                ]);
            }
            DB::commit();
            return new CreateResponse($form);
        } catch (Exception $e) {
            DB::rollBack();
            throw new FailedToBuildFormException($e);
        }
    }
}
