<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upvote;
use App\Models\Feature;


class UpvoteController extends Controller
{
    public function store(Request $request, Feature $feature)
    {
        $data=$request->validate([
            'upvote'=> ['required','boolean'],
        ]);

        Upvote::updateOrCreate
        (
            ['feature_id' => $feature->id,'user_id' =>auth()->id()],
            ['upvote'=> $data['upvote']]
        );
        // return to_route('feature.index');
        return back();
    }

    public function destroy (Feature $feature) 
    {
        $feature->upvotes()->where('user_id', auth()->id())->delete();

        // return to_route('feature.index');
        return back();
    }
}
