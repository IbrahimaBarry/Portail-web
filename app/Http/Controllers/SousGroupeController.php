<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SousGroupe;

class SousGroupeController extends Controller
{ 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sousGroupe = new SousGroupe();
        $sousGroupe->name = $request['name'];
        $sousGroupe->groupe_id = $request['groupe_id'];
        $sousGroupe->themes = implode(',', $request['themes']);

        $sousGroupe->save();

        return redirect()->back()->with('success', 'Groupe créé avec succès');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sousGroupe = SousGroupe::findOrFail($id);
        $sousGroupe->themes = implode(',', $request['themes']);

        $sousGroupe->save();

        return redirect()->back()->with('success', 'Groupe modifié avec succès');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sousGroupe = SousGroupe::findOrFail($id);
        $sousGroupe->delete();

        return redirect()->back()->with('success', 'Le groupe a été supprimer avec succès');
    }   //
}
