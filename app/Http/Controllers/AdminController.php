<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Keyword;
use App\Repositories\Solarium;
use App\Repositories\Alert;
use App\Groupe;

class AdminController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->middleware('auth');
    	$this->middleware('admin');
    }

    public function index(\Solarium\Client $client)
    {
        $nbrUser = count(User::where('groupe_id', '<>', 1)->get());
        $nbrGroupe = count(Groupe::where('id', '<>', 1)->get());
        $indexed = (new Solarium($client))->indexed();
        $nbrKeyword = count(Keyword::all());
    	return view('admin.dashboard', compact('nbrGroupe', 'nbrUser', 'indexed', 'nbrKeyword'));
    }

    public function theme(){
        return view('admin.theme');
    }

    public function indexing(\Solarium\Client $client)
    {
        (new Solarium($client))->indexing();

        (new Alert($client))->index();

        return redirect()->route('admin.dashboard');
    }

    public function showUsers()
    {
        $users = User::paginate('10');

        return view('admin.users', compact('users'));
    }

}
