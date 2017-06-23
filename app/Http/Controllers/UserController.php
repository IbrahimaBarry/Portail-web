<?php

namespace App\Http\Controllers;

use App\User;
use App\Keyword;
use App\Groupe;
use Illuminate\Http\Request;
use Carbon\carbon;
use Gate;
use Illuminate\Support\Facades\Auth;
use App\Permission;

class UserController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $users = User::select()->orderBy('updated_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create', User::class))
        {
            return redirect()->back()->with('error', 'Vous n êtes pas autorisé à éffectuer cette action');
        }

        $groupes = Groupe::all();
        $permissions = Permission::all();
        return view('admin.createUser', compact('groupes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('read', User::class))
        {
            return redirect()->back()->with('error', 'Vous n êtes pas autorisé à éffectuer cette action');
        }

        $user = User::findOrFail($id);
        $keywords = $user->groupe()->first()->keywords;
        return view('admin.profil', compact('user', 'keywords'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('update', User::class))
        {
            return redirect()->back()->with('error', 'Vous n êtes pas autorisé à éffectuer cette action');
        }

        $user = User::findOrFail($id);
        $user->email = $request['email'];
        $user->tel = $request['tel'];
        $user->address = $request['address'];
        $user->abonnement->update(['end_date' => $request['end_date']]);

        $request['tags'] = explode( ',', $request['tags']);
        $keywords_id = [];
        foreach ($request['tags'] as $val)
        {
            $keyword = Keyword::firstOrCreate(['name' => $val]);
            array_push($keywords_id, $keyword->id);
        }
        $user->keywords()->detach();
        $user->keywords()->attach($keywords_id === null ? [] : $keywords_id);

        $user->updated_at = Carbon::now();

        $user->save();

        return redirect()->back()->with('success', 'Modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('destroy', User::class))
        {
            return redirect()->back()->with('error', 'Vous n êtes pas autorisé à éffectuer cette action');
        }

        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->back()->with('success', 'Le client a été supprimer avec succès');
    }
}
