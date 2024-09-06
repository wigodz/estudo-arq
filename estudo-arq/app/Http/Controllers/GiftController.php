<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiftRequest;
use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function store(GiftRequest $request)
    {
        $imagePath = null;

        if( $request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
        } 

        Gift::create([
            'name' => $request->name,
            'description' => $request->description,
            'url' => $request->url,
            'image_path' => $imagePath,
        ]);

        return to_route('presentes.index');
    }

    public function update (GiftRequest $request)
    {
        Gift::find($request->id)
            ->update([
            'name' => $request->name,
            'description' => $request->description,
            'url' => $request->url 
            ]);

        return to_route('presentes.index');
    }
    
    public function delete(Request $request)
    {
        Gift::find($request->id)
            ->delete();

        return to_route('presentes.index');
    }

    public function show ()
    {
        $gifts = Gift::all()->toArray();

        return view('presentes.index', compact('gifts'));
    }
}
