<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function generateShortLink(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'original_url' => ['required', 'url', 'max:255']
        ]);

        do {
            $shortCode = preg_replace('/[^a-zA-Z0-9]/', '', Str::random(6));
            $shortCode = substr($shortCode, 0, 6);
            $shortUrl = $shortCode;
        } while (Link::where('short_url', $shortUrl)->exists());

        Link::create([
            'user_id' => Auth::id(),
            'original_url' => $validated['original_url'],
            'short_url' => $shortUrl
        ]);

        return response()->json([
            'short_url' => $shortUrl
        ]);
    }

    public function destination_url(Request $request): RedirectResponse
    {
        $shortURL = $request->path();
        $destinationURL = DB::table('links')->where('short_url', $shortURL)->value('original_url');
        return redirect()->to($destinationURL);
    }

    public function getLinks(): JsonResponse
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $links = $user->links()->get();

            return response()->json([
                'links' => $links
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        $link = Link::find($id);

        return response()->json([
            'link' => $link
        ], 200);
    }

    public function delete(int $id): JsonResponse
    {
        $link = Link::find($id);

        if (!$link) {
            return response()->json([
                'message' => 'Запись в таблице Links не найдена',
            ], 404);
        }

        $link->delete();

        return response()->json([
            'message' => 'Запись в таблице Link успешно удалена',
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'original_url' => ['required', 'string', 'max:255'],
            'short_url' => ['required', 'string', 'max:255']
        ]);

        $link = Link::find($id);

        if(!$link) {
            return response()->json([
                'success' => false,
                'message' => 'Запись не найдена.'
            ], 404);
        }

        $link->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Успешно обновленно'
        ]);
    }
}
