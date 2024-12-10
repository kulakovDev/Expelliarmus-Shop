<?php

namespace Modules\User\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Services\Cache\CacheService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\Http\Resources\UserResource;

class UserController extends Controller
{
    public function __construct(
        private CacheService $cacheService
    ) {
    }

    public function user(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function store(Request $request, CreateNewUser $action): JsonResponse
    {
        $user = $action->create($request->all());

        event(new Registered($user));

        return response()->json(status: 201);
    }
}