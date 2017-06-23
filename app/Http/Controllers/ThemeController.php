<?php

namespace App\Http\Controllers;

use App\Theme;
use App\Keyword;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::all();

        return view('admin.theme', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $theme = new Theme();
        $theme->name = $request->name;

        $theme->save();

        $request['tags'] = explode( ',', $request['tags']);
        $keywords_id = [];
        foreach ($request['tags'] as $val)
        {
            $keyword = Keyword::firstOrCreate(['name' => $val]);
            array_push($keywords_id, $keyword->id);
        }

        $theme->keywords()->attach($keywords_id === null ? [] : $keywords_id);

        return redirect()->back()->with('success', 'theme ajouter avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $themes = Theme::all();
        $th = Theme::findOrFail($id);

        return view('admin.themeInfo', compact('themes', 'th'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function edit(Theme $theme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $theme = Theme::findOrFail($id);

        $request['tags'] = explode( ',', $request['tags']);
        $keywords_id = [];
        foreach ($request['tags'] as $val)
        {
            $keyword = Keyword::firstOrCreate(['name' => $val]);
            array_push($keywords_id, $keyword->id);
        }

        $theme->keywords()->attach($keywords_id === null ? [] : $keywords_id);

        $theme->updated_at = Carbon::now();
        $theme->save();

        return redirect()->back()->with('success', 'theme modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theme = Theme::findOrFail($id);
        $theme->delete();

        return redirect()->route('themes.index')->with('success', 'Le theme a été supprimer avec succès');
    }
}
