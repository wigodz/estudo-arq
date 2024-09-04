<?php

namespace App\Http\Controllers;

use App\Http\Requests\GiftRequest;
use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function store(GiftRequest $request)
    {
        if(! $request->hasFile('image')) {
            $imagePath = null;
        } else {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Gift::create([
            'name' => $request->name,
            'description' => $request->description,
            'url' => $request->url,
            'image_path' => $imagePath
        ]);

            return response()->json('presente criado');
    }
    
}
