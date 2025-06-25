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
            'categories' => $request->categories,
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
    
    public function deleteGift(Request $request)
    {
        Gift::find($request->id)
            ->delete();

        return response()->json(['message'=> 'presente deletado com sucesso.', 'success' => true]);
    }

    public function show ()
    {
        $userLogado = auth()->user();
        $presentesEscolhidos = Gift::where('user_id', $userLogado->id)->count();

        return view('presentes.index', compact('userLogado', 'presentesEscolhidos'));
    }

    public function getGifts()
    {
        $query = Gift::when(request()->input('category'), function ($q) {
            $q->where('categories', request()->input('category'));
        });
            
        $gifts = $query->orderBy('id','desc')
            ->paginate(12);

        return response()->json($gifts);
    }

    public function choseGift(Request $request)
    {
        $valideData = $request->validate([
            'id' => 'required|integer',
        ]);

        $gift = Gift::find($valideData['id']);

        if (! $gift) {
            return response()->json(['message' => 'presente nao encontrado.'], 404);
        }

        $data = [
            'user_id'   => auth()->user()->id,
            'avaliable' => false,
        ];

        $gift->update($data);

        return response()->json(['message'=> 'presente escolhido com sucesso.', 'success' => true]);
    }

    public function categoriesGift()
    {
        return Gift::getCategorias();
    }
}
