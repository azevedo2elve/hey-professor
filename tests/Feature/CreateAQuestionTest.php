<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('sould be able to create a new question bigger than 255 characters', function () { // 1º requisito em que a pergunta não pode ser grande
    // Arrange :: preparar
    $user = User::factory()->create(); // criar um dado de user falso
    actingAs($user); // logar como o usuário

    // Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]); //post do pest laravel para a rota question.create passando * 260 caracteres mais um question mark ?

    //Assert :: verificar
    $request->assertRedirect(route('dashboard')); // verificar o que vou redirecionar para o dashboard
    assertDatabaseCount('questions', 1); // verificar que o banco de dados tenha pelo menos 1 registo
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']); // banco de dados questions tenha uma pergunta com 260 caracteres seguido de um ponto de interrogação

});

it('should check if ends with question mark', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10), // garantir que passe no test do min necessário
    ]);

    // Assert :: verificar
    $request->assertSessionHasErrors([
        'question' => 'Are you sure that is a question? It is missing the question mark in the end.',
    ]); // verificar que teve o erro
    assertDatabaseCount('questions', 0); // e verificar que o erro não foi inserido, ou seja, a question
});

it('should have at least 10 characters', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    // Assert :: verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]); // verificar que a sessão teve o erro fornecido, pegar a chave que tem as validações com o min
    assertDatabaseCount('questions', 0); // e verificar que o erro não foi inserido
});

it('should create as a draft all the time', function () {
    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    // Act :: agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    //Assert :: verificar
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
        'draft'    => true,
    ]);
});
