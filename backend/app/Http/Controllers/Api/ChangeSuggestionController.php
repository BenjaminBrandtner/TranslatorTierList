<?php

namespace App\Http\Controllers\Api;

use App\ChangeSuggestion;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChangeSuggestionResource;
use App\TranslationChannel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChangeSuggestionController extends Controller
{
    public function index(TranslationChannel $translationChannel)
    {
        return ChangeSuggestionResource::collection($translationChannel->changeSuggestions);
    }

    public function store(TranslationChannel $translationChannel, Request $request)
    {
        abort_unless(
            $request->hasAny(['tier', 'goodEditor']),
            422,
            'Change Suggestions must have at least one non-empty field.'
        );

        $validated = $request->validate(
            [
                'tier' => Rule::in(['S', 'A', 'B', 'C', 'U']),
                'goodEditor' => 'boolean',
            ]
        );

        ChangeSuggestion::create(
            [
                'translation_channel_id' => $translationChannel->id,
                'tier' => $validated['tier'] ?? null,
                'good_editor' => $validated['goodEditor'] ?? null,
            ]
        );
    }
}
