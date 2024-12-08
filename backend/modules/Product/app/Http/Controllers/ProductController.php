<?php

declare(strict_types=1);

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Http\Requests\ProductCreateRequest;

class ProductController extends Controller
{
    public function store(ProductCreateRequest $request)
    {
    }
}