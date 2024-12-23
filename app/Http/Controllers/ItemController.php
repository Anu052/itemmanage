<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ItemController;
use App\Models\Item;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title.*' => 'required|string|max:255',
            'description.*' => 'required|string|max:250',
            'qty.*' => 'required|integer|min:1',
            'price.*' => 'required|numeric|min:0',
            'date.*' => 'required|date',
            'image.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        foreach ($request->file('image') as $index => $image) {
            $path = $image->store('images', 'public');
            Item::create([
                'title' => $request->title[$index],
                'description' => $request->description[$index],
                'qty' => $request->qty[$index],
                'price' => $request->price[$index],
                'date' => $request->date[$index],
                'image' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Items saved successfully!');
    }

    public function index(Request $request)
    {
        $query = Item::query();
        if ($request->has('title') && $request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('date') && $request->date) {
            $date = Carbon::createFromFormat('Y-m-d', $request->date)->toDateString();
            $query->whereDate('date', $date);
        }
        $items = $query->paginate(10);

        return view('item', compact('items'));
    }
}
