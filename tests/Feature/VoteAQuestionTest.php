<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('should be able to like a question', function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create();

    post(route('question.like', $question))
        ->assertRedirect(); // espera o redirecionamento no final e valida o status code

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
        'user_id'     => $user->id,
    ]);
    // SELECT * FROM votes WHERE question_id = ? AND like = 1 AND unlike = 0 AND user_id = ? EXIST
});
