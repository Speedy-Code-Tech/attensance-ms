<?php

namespace App\Http\Controllers;
use App\Models\Link;

use Illuminate\Http\Request;
class LinkController extends Controller
{
    public function index(Request $request)
    {
        $links = Link::all();
    
        return view('links.index', compact('links'));
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'url' => 'required|url',
            'category' => 'required|string'
        ]);

        $link = Link::create([
            'title' => $data['title'],
            'url' => $data['url'],
            'category' => $data['category']
        ]);

        return redirect()->route('links.index')->with('success', 'Link created successfully!');
    }

    public function show(Link $link)
    {
        return view('links.show', compact('link'));
    }

    public function edit(Link $link)
    {
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, Link $link)
    {
        $request->validate([
            'title' => 'required|string',
            'url' => 'required|url',
            'category' => 'required|string'
        ]);

        $link->update($request->all());

        return redirect()->route('links.index')->with('success', 'Link updated successfully!');
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->route('links.index')->with('success', 'Link deleted successfully!');
    }
}