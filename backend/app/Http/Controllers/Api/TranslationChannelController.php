<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TranslationChannelResource;
use App\TranslationChannel;

class TranslationChannelController extends Controller
{
    public function index()
    {
        return TranslationChannelResource::collection(TranslationChannel::all());
    }
}
