<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    public function store(): RedirectResponse //método público store que vai retornar um RedirectResponse (Illuminate/http/RedirectResponde)
    {
        $attributes = request()->validate([
            'question' => ['required'],
        ]);

        Question::query()->create($attributes); // do meu model criar uma query, criar um registro que vai receber o question e vai ter o request()->validate(question) através do $attributes

        return to_route('dashboard');
    }
}
