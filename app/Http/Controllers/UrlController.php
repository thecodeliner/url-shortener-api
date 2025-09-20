<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;

use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function store(Request $request){

        $validate = $request->validate([

            'original_url' => 'required|url',


        ]);

        do{
            $shortUrl = Str::random(5);

        }while (Url::where('short_url', $shortUrl)->exists());


        $url = Url::create([

            'original_url' => $validate['original_url'],
            'short_url'    => $shortUrl,
            'user_id'      => $request->user()->id,

        ]);

        return response()->json([

            'original_url' => $url->original_url,
            'short_url' => url($url->short_url),


        ]);
    }

    public function redirect($shortUrl){

        $url = Url::where('short_url', $shortUrl)->first();

    if (!$url) {
        // Return JSON for API requests or a 404 page
        return response()->json(['message' => 'Short URL not found'], 404);
    }

    // Increment clicks safely
    $url->increment('clicks');

    // Redirect to original URL
    return redirect()->away($url->original_url);

    }

    public function index(Request $request){
        if (!$request->user()) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        $urls = Url::where('user_id', $request->user()->id)->get([
            'original_url',
            'short_url',
            'clicks'
        ]);

        return response()->json([
            'status' => true,
            'urls' => $urls
        ]);

    }
}
