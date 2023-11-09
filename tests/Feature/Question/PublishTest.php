<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should be able to publish a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create(['draft' => true]);

    actingAs($user);

    // put é porque está atualizando a pergunta, atualizando uma informação que vai ser o draft
    put(route('question.publish', $question))
        ->assertRedirect();

    $question->refresh();

    expect($question)
        ->draft->toBeFalse();
});
