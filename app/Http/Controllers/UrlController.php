<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('urls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'url' => 'required|url',
        ]);
        $validator->validate();

        $maxAttemptNumberToFindUniqueShortCode = 5; // anti infinity loop
        do {
            $shortCode = Str::random(10);
            $maxAttemptNumberToFindUniqueShortCode--;
            $isShortCodeExists = Url::find($shortCode);
        } while ($maxAttemptNumberToFindUniqueShortCode && $isShortCodeExists);

        if ($isShortCodeExists) {
            $validator->errors()->add('url', __('validation.short_code_generation_fail'));
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        Url::create([
            'short_code' => $shortCode,
            'url' => $request->input('url'),
        ]);

        return redirect()
            ->back()
            ->with(['success' => $shortCode])
            ->withInput();
    }

    /**
     * Redirect to original url by short url
     *
     * @param  string $shortCode
     * @return \Illuminate\Http\Response
     */
    public function redirect($shortCode)
    {
        $urlRecord = Url::find($shortCode);
        if ($urlRecord) {
            return redirect($urlRecord->url);
        }
        return abort(404, __('messages.recordDoesNotExist'));
    }
}
