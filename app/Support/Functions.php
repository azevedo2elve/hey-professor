<?php

use App\Models\User;

// função global

function user(): ?User
{
    if(auth()->check()) {
        return auth()->user();
    }

    return null;
}
