<?php

namespace App\Http\Controllers\NovaApi;

use App\Http\Resources\API\PopupResource;
use App\Models\Popup;

class CampaignController extends \Laravel\Nova\Http\Controllers\ResourceShowController
{
    public function index()
    {
        $result = Popup::where('status', 'active')->latest()->get();
        return response(PopupResource::collection($result));
    }
}
