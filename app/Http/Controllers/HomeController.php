<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Solarium;
use App\Repositories\Articles;
use Illuminate\Support\Facades\Auth;
use App\Theme;

class HomeController extends Controller
{
    protected $client;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\Solarium\Client $client)
    {
        $this->middleware('auth');
        $this->middleware('abonnement');

        $this->client = $client;
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultset = (new Articles($this->client))->index();
        $facet1 = $resultset->getFacetSet()->getFacet('language');
        $facet2 = $resultset->getFacetSet()->getFacet('author');
        $facet3 = $resultset->getFacetSet()->getFacet('source');

        $user = Auth::user();
        if ($user->groupe->id === 1) {
            $themes = Theme::all();
        } 
        elseif ($user->role->name === 'Admin') {
            $themes = $user->groupe->themes;
        }
        else {
            $themes = explode(',', $user->sousGroupe->keywords);
        }

        return view('home', compact('resultset', 'facet1', 'facet2', 'facet3', 'themes'));
    }

    public function sort($data)
    {
        $resultset = (new Articles($this->client))->sort($data);
        $facet1 = $resultset->getFacetSet()->getFacet('language');
        $facet2 = $resultset->getFacetSet()->getFacet('author');
        $facet3 = $resultset->getFacetSet()->getFacet('source');

        $user = Auth::user();
        if ($user->role->name === 'SuperAdmin') {
            $themes = Theme::all();
        } 
        elseif ($user->role->name === 'Admin') {
            $themes = $user->groupe->themes;
        }
        else {
            $themes = explode(',', $user->sousGroupe->keywords);
        }

        return view('home', compact('resultset', 'facet1', 'facet2', 'facet3', 'themes'));   
    }

    public function search(Request $request)
    {
        $resultset = (new Articles($this->client))->search($request->data);
        $facet1 = $resultset->getFacetSet()->getFacet('language');
        $facet2 = $resultset->getFacetSet()->getFacet('author');
        $facet3 = $resultset->getFacetSet()->getFacet('source');

        $user = Auth::user();
        if ($user->role->name === 'SuperAdmin') {
            $themes = Theme::all();
        } 
        elseif ($user->role->name === 'Admin') {
            $themes = $user->groupe->themes;
        }
        else {
            $themes = explode(',', $user->sousGroupe->keywords);
        }

        $search = $request->data;

        return view('search', compact('resultset', 'search', 'facet1', 'facet2', 'facet3', 'themes'));   
    }

    public function show($id)
    {
        $resultset = (new Articles($this->client))->show($id);
        $facet1 = $resultset->getFacetSet()->getFacet('language');
        $facet2 = $resultset->getFacetSet()->getFacet('author');
        $facet3 = $resultset->getFacetSet()->getFacet('source');

        $user = Auth::user();
        if ($user->role->name === 'SuperAdmin') {
            $themes = Theme::all();
        } 
        elseif ($user->role->name === 'Admin') {
            $themes = $user->groupe->themes;
        }
        else {
            $themes = explode(',', $user->sousGroupe->keywords);
        }

        return view('article', compact('resultset', 'search', 'facet1', 'facet2', 'facet3', 'themes'));
    }

    public function download(Request $request)
    {
        $data = file_get_contents('Articles/pdf_download.txt');
        $data++;
        file_put_contents('Articles/pdf_download.txt', $data);
        return response()->download($request->file);
    }

}
