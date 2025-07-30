<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        return Item::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:items,name',
            'quantity'    => 'required|integer|min:0',
            'price'       => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        return Item::create($validated);
    }

    public function show($id)
    {
        return Item::findOrFail($id);
    }

    public function update(Request $request, $id)
{
    $item = Item::findOrFail($id);

    $validated = $request->validate([
        'name'        => 'sometimes|required|string|max:255|unique:items,name,' . $item->id,
        'quantity'    => 'sometimes|required|integer|min:0',
        'price'       => 'sometimes|nullable|numeric|min:0',
        'description' => 'sometimes|nullable|string',
        'image'       => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($item->image) {
            \Storage::disk('public')->delete($item->image);
            \Log::info('Ada file yang dikirim!');
        }
        $validated['image'] = $request->file('image')->store('items', 'public');
    } elseif ($request->has('image') && !$request->file('image')) {
        // Postman kirim key image kosong -> jangan timpa
        unset($validated['image']);
    }

    $item->update($validated);

    return response()->json([
        'message'   => 'Item berhasil diupdate',
        'data'      => $item,
        'image_url' => $item->image ? asset('storage/'.$item->image) : null,
    ]);
}

    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted']);
    }
}
