<?php

namespace App\Http\Controllers\Api;

use App\Http\Clients\Youtube\YoutubeClient;
use App\Http\Controllers\Controller;
use App\Http\Resources\TranslationChannelResource;
use App\Rules\YoutubeChannelUrl;
use App\TranslationChannel;
use Illuminate\Http\Request;

class TranslationChannelController extends Controller
{
    public function index()
    {
        return TranslationChannelResource::collection(TranslationChannel::all());
    }

    public function search(Request $request)
    {
        $validated = $request->validate(
            [
                'url' => ['required', new YoutubeChannelUrl()],
            ]
        );

        $channelId = YoutubeClient::getChannelIdFromUrl($validated['url']);

        return TranslationChannelResource::make(TranslationChannel::whereChannelId($channelId)->firstOrFail());
    }
}
