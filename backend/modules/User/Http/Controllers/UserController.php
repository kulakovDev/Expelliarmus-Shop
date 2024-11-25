<?php

declare(strict_types=1);

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Http\Resources\UserResource;

class UserController extends Controller
{
    public function user(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}