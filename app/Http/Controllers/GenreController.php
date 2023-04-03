<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GenreController extends Controller
{
    private string $url = 'http://localhost:8080/genres';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get($this->url);
        if ($response->ok())
        {
            $genres = json_decode($response->body());
            return view('genres.index', compact('genres'));
        }
        else
        {
            return view('genres.index', []);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->get('genre');
        $response = Http::post($this->url, [
            'name' => $name
        ]);

        $msg = 'Could not create genre';
        if ($response->created())
        {
          $msg = 'Genre created';
        }


        return view('genres.create', compact('msg'));
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
}
