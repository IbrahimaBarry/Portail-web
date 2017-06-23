<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;
use App\Groupe;

class NewsletterController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index($id)
    {
    	$groupe = Groupe::findOrFail($id);

    	if ($groupe->newsletter === 0) {
	    	foreach ($groupe->users as $user) {
	    		Newsletter::firstOrCreate(['user_id' => $user->id]);
	    	}

	    	$groupe->newsletter = true;
	    	$groupe->save();

	    	return redirect()->back()->with('success', 'Newsletter activé pour ce client');
    	}

    	else {
    		foreach ($groupe->users as $user) {
	    		$newsletter = $user->newsletter;
	    		$newsletter->delete();
	    	}

	    	$groupe->newsletter = false;
	    	$groupe->save();

	    	return redirect()->back()->with('success', 'Newsletter désactivé pour ce client');
    	}
    }
}
