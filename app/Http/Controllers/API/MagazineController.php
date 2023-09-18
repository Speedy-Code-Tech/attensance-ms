<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MagazineResource;
use App\Models\Magazine;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::all();

        return MagazineResource::collection($magazines);
    }

    public function show(Magazine $magazine)
    {
        return new MagazineResource($magazine);
    }
}