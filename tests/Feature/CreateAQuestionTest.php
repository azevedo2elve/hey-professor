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

});

it('should have at least 10 characters', function () {

});
