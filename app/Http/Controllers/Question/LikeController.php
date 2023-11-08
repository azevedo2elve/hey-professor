<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{Question, User, Vote};
use Illuminate\Http\{RedirectResponse, Request};

class LikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {

        // user() é uma função global criada no app/support/Functions.php que foi inicializada no composer depois do autoload no "files"
        user()->like($question); // o user autenticado gostou dessa pergunta

        return back();
    }
}
