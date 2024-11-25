<?php

use Modules\User\Providers\UserServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    UserServiceProvider::class,
];
