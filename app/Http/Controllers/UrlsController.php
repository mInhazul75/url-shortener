<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\Auth;
use Str;

class UrlsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $urls = Url::where(
                'creator_id',
                Auth::user()->id
            )->get();
            return view('pages.url.create', compact('urls'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $urls = Url::where(
                    'creator_id',
                    Auth::user()->id
                )->get();
            return view('pages.url.create', compact('urls'));
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...

            $request->validate([
                'original_url' => 'required|url',
            ]);

            $url = Url::create([
                'original_url' => $request->input('original_url'),
                'short_url' =>  Str::random(5),
                'clicks' => 0,
                'creator_id' => Auth::user()->id
            ]);

            return response()->json($url);
        } catch (\Exception  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }




    public function redirect($slug)
    {
        try {
            $url = Url::where('short_url', $slug)->first();


            if ($url) {
                $url->increment('clicks');

                return redirect($url->original_url);
            }
        } catch (\Throwable $th) {

            throw $th;
        }
    }
}
