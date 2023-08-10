<?php

namespace App\Http\Controllers;

use App\Events\FormSubmitted;
use App\Models\Answer;
use App\Models\Form;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    /**
     * Get from by id
     *
     * @param $hashId
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show($hashId)
    {
        $form = Form::with('questions.component')->findOrFailByHashId($hashId);
        return view('form', [
            'form' => $form,
        ]);
    }

    /**
     * Update form by id
     *
     * @param $hashId
     * @param Request $request // use Laravel built-in Request since Validation have to done dynamically
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function update($hashId, Request $request)
    {
        $form = Form::with(['questions.component', 'owner'])->findOrFailByHashId($hashId);
        $rules = [];
        foreach ($form->questions as $question) {
            if ($question->is_required) {
                $rules[$question->input_name] = 'required';
            }
        }

        $validator = Validator::make($request->all(), $rules, [
            '*.required' => 'This field is required.',
        ]);
        $validator->validate();

        try {
            DB::beginTransaction();

            $submission = $form->submissions()->create([
                'form_version' => $form->version,
            ]);

            foreach ($form->questions as $question) {
                $answer = new Answer([
                    'text' => $request->get($question->input_name),
                    'question_id' => $question->id,
                    'submission_id' => $submission->id,
                ]);
                $answer->question()->associate($question);
                // associate created & loaded answers with submission
                // to reduce transactions
                $submission->answers->add($answer);
            }

            // associate loaded from with submission
            // to reduce transactions
            $submission->form()->associate($form);

            DB::commit();
            FormSubmitted::dispatch($submission->toArray());

            return view('form', [
                'form' => $form,
                'success' => true,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage(), $e->getTrace());
            return view('form', [
                'form' => $form,
                'success' => false,
            ]);
        }
    }
}
