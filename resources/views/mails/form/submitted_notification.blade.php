Hello {{ $form['owner']['name'] }},
New answer "{{ $form['title'] }}" form were submitted.

Answers:

@foreach($answers as $answer)
{{ $answer['question']['text'] }} : {{ $answer['text'] }}
@endforeach
