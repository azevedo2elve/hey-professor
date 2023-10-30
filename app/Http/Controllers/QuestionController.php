<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function store(): RedirectResponse //método público store que vai retornar um RedirectResponse (Illuminate/http/RedirectResponde)
    {
        $attributes = request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) { // Custom Validation Rules conforme doc laravel Using Closures
                    if ($value[strlen($value) - 1] != '?') { // se o ultimo ch for diferente de ?
                        $fail('Are you sure that is a question? It is missing the question mark in the end.'); // vai mostrar essa mensagem
                    }
                },
            ],
        ]);

        Question::query()->create($attributes); // do meu model criar uma query, criar um registro que vai receber o question e vai ter o request()->validate(question) através do $attributes

        return to_route('dashboard');
    }
}
