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

        $shortUrl = Str::random(5);

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
}
