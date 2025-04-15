<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booth;

class BoothController extends Controller
{
    public function index()
    {
        $booths = Booth::all(); // Fetch all booths from the database
        return view('booths.index', compact('booths'));
    }

    public function show($id)
    {
        $booth = Booth::findOrFail($id); // Fetch a single booth by ID
        return view('booths.boothbooking', compact('booth', $id));
    }
    

    /**
     * Store a newly created booth in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'img' => 'nullable|image|max:2048', // Optional image upload
        ]);

        $booth = new Booth();
        $booth->name = $validated['name'];
        $booth->description = $validated['description'] ?? null;
        $booth->location = $validated['location'];
        $booth->price = $validated['price'];
        
        // Handle image upload if present
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('booth-images', 'public');
            $booth->img = '/storage/' . $imagePath;
        }
        
        $booth->save();
        
        return redirect()->route('booths.show', $booth->id)
                         ->with('success', 'Booth created successfully!');
    }

    /**
     * Show the form for editing the specified booth.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booth = Booth::findOrFail($id);
        return view('booths.edit', compact('booth'));
    }

    /**
     * Update the specified booth in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'img' => 'nullable|image|max:2048', // Optional image upload
        ]);
        
        $booth = Booth::findOrFail($id);
        $booth->name = $validated['name'];
        $booth->description = $validated['description'] ?? null;
        $booth->location = $validated['location'];
        $booth->price = $validated['price'];
        
        // Handle image upload if present
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('booth-images', 'public');
            $booth->img = '/storage/' . $imagePath;
        }
        
        $booth->save();
        
        return redirect()->route('booths.show', $booth->id)
                         ->with('success', 'Booth updated successfully!');
    }

    /**
     * Remove the specified booth from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booth = Booth::findOrFail($id);
        $booth->delete();
        
        return redirect()->route('booths.index')
                         ->with('success', 'Booth deleted successfully!');
    }
}