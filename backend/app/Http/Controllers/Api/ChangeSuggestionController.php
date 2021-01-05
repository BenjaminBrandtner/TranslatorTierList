<?php

namespace App\Http\Controllers\Api;

use App\ChangeSuggestion;
use App\Http\Clients\Youtube\YoutubeClient;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChangeSuggestionResource;
use App\Rules\YoutubeChannelUrl;
use App\TranslationChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;

class ChangeSuggestionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'url' => ['required', new YoutubeChannelUrl()],
                'tier' => [Rule::in(TranslationChannel::$possibleTiers)],
                'goodEditor' => 'boolean',
            ]
        );

        $channelId = YoutubeClient::getChannelIdFromUrl($validated['url']);

        ChangeSuggestion::create(
            [
                'channel_id' => $channelId,
                'tier' => $validated['tier'] ?? null,
                'good_editor' => $validated['goodEditor'] ?? null,
            ]
        );

        return Response::json([], 201);
    }

    public function search(Request $request)
    {
        $validated = $request->validate(
            [
                'url' => ['required', new YoutubeChannelUrl()],
            ]
        );

        $channelId = YoutubeClient::getChannelIdFromUrl($validated['url']);
        $changeSuggestions = ChangeSuggestion::whereChannelId($channelId)->get();

        if ($changeSuggestions->isEmpty()) {
            abort(404);
        }

        return ChangeSuggestionResource::collection($changeSuggestions);
    }
}
