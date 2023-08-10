<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Survey</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased">
<div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
    <div class="container max-w-screen-lg mx-auto">
        <div>
            <h2 class="font-semibold text-xl text-gray-600">{{ env('APP_NAME')  }}</h2>
            <p class="text-gray-500 mb-6">Build form and collect answers.</p>

            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600">
                        <p class="font-medium text-lg">{{ $form->title }}</p>
                        <p>{{ $form->description }}</p>
                    </div>
                    <form action="{{ route('form.update', $form->hashId)  }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                            @isset($success)
                                @if($success)
                                    <div class="md:col-span-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Success!</strong>
                                        <span class="block sm:inline">Your answers were submitted.</span>
                                    </div>
                                @else
                                    <div class="md:col-span-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">Error occurred! Please try again.</strong>
                                    </div>
                                @endif
                            @endisset

                            @foreach($form->questions as $question)
                                    @php
                                        $required = $question->is_required ? 'required' : '';
                                        $attributes = "id=\"{$question->id}\" name=\"{$question->input_name}\" placeholder=\"{$question->hint}\" $required";
                                        if (old($question->input_name)) {
                                            $attributes .= " value=\"" . old($question->input_name) . "\"";
                                        }
                                    @endphp
                                    <div class="md:col-span-5">
                                        <label for="{{ $question->id  }}">{{ $question->text }}</label>
                                        {{-- Apply element id, hint AKA placeholder and requirement --}}
                                        {!!
                                            sprintf(
                                                $question->component->content, $attributes
                                            )
                                        !!}
                                        @error($question->text)
                                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>

                            <div class="md:col-span-5 text-right mt-6">
                                <div class="inline-flex items-end">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
