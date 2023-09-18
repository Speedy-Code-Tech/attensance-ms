<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Link;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        if ($category) {
            $links = Link::where('category', $category)->get();
        } else {
            $links = Link::all();
        }

        return response()->json($links);
    }
}