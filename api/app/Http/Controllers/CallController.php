<?php

namespace App\Http\Controllers;

use App\Http\Requests\CallRequest;
use App\Models\Call;

class CallController extends Controller
{
    public function store(CallRequest $request)
    {
        Call::create($request->all());
        return response(['success'], 201);
    }
}
