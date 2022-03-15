<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function store(NewsletterRequest $request)
    {
        Newsletter::create($request->all());
        return response(['success'], 201);
    }
}
