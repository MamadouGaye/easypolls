<?php

use App\Models\Poll;
use Illuminate\Http\Request;

Route::get('/', function() {
    return view('home');
});

Route::post('/polls', function() {
    $poll = new Poll;

    $poll->question_text = request('question_text');
    $poll->choice_1 = request('question_choice_1');
    $poll->choice_2 = request('question_choice_2');
    $poll->choice_3 = request('question_choice_3');

    $poll->save();

    dd('Sondage créé avec succès!');
});

Route::get('/polls/{id}', function($id) {
    $poll = Poll::findOrFail($id);

    return view('polls.show', compact('poll'));
});

Route::post('/polls/{id}/vote', function(Request $request, $id) {
    $poll = Poll::findOrFail($id);

    request()->session()->put(request('choice'), request()->session()->get(request('choice')) + 1);

    return view('polls.show', compact('poll'));

});
