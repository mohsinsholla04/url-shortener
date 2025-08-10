<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    // Show the form to submit URLs
    public function index()
    {
        return view('welcome');
    }

    // Store the URL and generate short code
    public function shorten(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'original_url' => 'required|url|max:2048'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $originalUrl = $request->input('original_url');

        // Check if this URL already exists
        $existingUrl = Url::where('original_url', $originalUrl)->first();

        if ($existingUrl) {
            // Return existing short URL
            $shortUrl = request()->getSchemeAndHttpHost() . '/' . $existingUrl->short_code;
            return view('welcome', compact('shortUrl', 'originalUrl'));
        }

        // Create new short URL
        $shortCode = Url::generateShortCode();
        
        Url::create([
            'original_url' => $originalUrl,
            'short_code' => $shortCode,
        ]);

        $shortUrl = request()->getSchemeAndHttpHost() . '/' . $shortCode;

        return view('welcome', compact('shortUrl', 'originalUrl'));
    }

    // Redirect to original URL
    public function redirect($shortCode)
    {
        $url = Url::where('short_code', $shortCode)->first();

        if (!$url) {
            abort(404, 'Short URL not found');
        }

        return redirect($url->original_url);
    }
}
