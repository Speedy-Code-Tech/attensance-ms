<?php

namespace App\Http\Controllers;

use App\Models\Magazine;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class MagazineController extends Controller
{
    // Display a list of all magazines
    public function index()
    {
        $magazines = Magazine::all();
        return view('magazines.index', compact('magazines'));
    }

    // Show the form for creating a new magazine
    public function create()
    {
        return view('magazines.create');
    }

    
    // Store a newly created magazine in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'issue' => 'required|date',
            'pdf' => 'required|mimes:pdf|max:25000',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        // Process the PDF file
        $pdfPath = $request->file('pdf')->store('magazines', 'public');

        // Process the thumbnail file (if included)
        $thumbnailPath = null; // Default value if the thumbnail is not included
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Generate a unique identifier (e.g., timestamp) for filename
        $uniqueIdentifier = time();

        $titleSlug = Str::slug($request->input('title'));

        // Append the title and unique identifier to the PDF file name
        $pdfFileName = $titleSlug . '_' . $uniqueIdentifier  . '.pdf';

        // Move the uploaded file to the desired storage path with the new filename
        Storage::disk('public')->move($pdfPath, 'magazines/' . $pdfFileName);

        // Append the title and unique identifier to the thumbnail file name (if included)
        $thumbnailFileName = null;
        if ($thumbnailPath) {
            $thumbnailFileName = $uniqueIdentifier . '_' . $request->input('title') . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            Storage::disk('public')->move($thumbnailPath, 'thumbnails/' . $thumbnailFileName);
        }

        // Save the magazine details to the database
        $magazine = new Magazine();
        $magazine->title = $request->input('title');
        $magazine->description = $request->input('description');
        $magazine->issue = $request->input('issue');
        $magazine->pdf_path = 'magazines/' . $pdfFileName;
        $magazine->thumbnail_path = $thumbnailFileName ? 'thumbnails/' . $thumbnailFileName : null;
        $magazine->user_id = auth()->user()->id;
        $magazine->save();

        // Redirect to the index page with a success message
        return redirect()->route('magazines.index')->with('success', 'Magazine created successfully!');
    }


    // Show the details of a specific magazine
    public function show(Magazine $magazine)
    {
        return view('magazines.show', compact('magazine'));
    }
    

    // Show the form for editing the specified magazine
    public function edit(Magazine $magazine)
    {
        return view('magazines.edit', compact('magazine'));
    }

    // Update the specified magazine in the database
    public function update(Request $request, Magazine $magazine)
    {
        $request->validate([
            'title' => 'required',
            'issue' => 'date',
            'pdf' => 'nullable|mimes:pdf|max:25000', // Ensure you have proper max size for the PDF
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:25000', // Set max size for the thumbnail image
            'description' => 'nullable',
        ]);

        $magazine->title = $request->input('title');
        $magazine->description = $request->input('description');
        $magazine->issue = $request->input('issue');

        if ($request->hasFile('pdf')) {
            // Generate a unique identifier (e.g., timestamp) for filename
            $uniqueIdentifier = time();
            $titleSlug = Str::slug($request->input('title'));

            Storage::delete($magazine->pdf_path);
            $pdfPath = $request->file('pdf')->store('magazines', 'public');
            $pdfFileName = $titleSlug . '_' . $uniqueIdentifier .  '.pdf';
            Storage::disk('public')->move($pdfPath, 'magazines/' . $pdfFileName);
            $magazine->pdf_path = 'magazines/' . $pdfFileName;
        }

        if ($request->hasFile('thumbnail')) {
            Storage::delete($magazine->thumbnail_path);
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $magazine->thumbnail_path = $thumbnailPath;
        }

        $magazine->save();

        return redirect()->route('magazines.index')->with('success', 'Magazine updated successfully.');
    }

    // Remove the specified magazine from the database
    public function destroy(Magazine $magazine)
    {
        Storage::delete($magazine->pdf_path);
        Storage::delete($magazine->thumbnail_path);

        $magazine->delete();

        return redirect()->route('magazines.index')->with('success', 'Magazine deleted successfully.');
    }

    public function uploadThumbnailPicture(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Set the allowed image types and size as needed
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');

            // You may want to store the $path in the database or use it for further processing

            return response()->json([
                'url' => asset('storage/' . $path),
                'path' => $path,
            ]);
        }

        return response()->json([
            'error' => 'File not found or invalid file format.',
        ], 400);
    }
}