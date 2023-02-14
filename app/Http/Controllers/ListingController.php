<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Contracts\Session\Session;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            // 'listings' => Listing::latest()->filter(request(['tag']))->get()
            'listings' => Listing::latest()->filter(request(['tag','search']))->paginate(5) // For show no. of pages
            // 'listings' => Listing::latest()->filter(request(['tag','search']))->simplepaginate(2) // It shows only next and previouse button
        ]);
    }

    public function show(Listing $listing)
    {
        // dd('he');
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show create form
    public function create()
    {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request)
    {
        // dd($request->file('logo')->store()); // Stoer file in Bydefault in storage->app
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'description' => 'required',
            'tags' => 'required'
        ]);
        // $formFields['logo'] = 'sfs';
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // dd($formFields); 

         Listing::create($formFields);

        // Session::flash('message')
        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Edit Form 
    public function edit(Listing $listing) {
        // dd($listing->title);
        return view('listings.edit',['listings' => $listing]);
    }

    public function update(Request $request, Listing $listing)
    {
        // dd($request->file('logo')->store()); // Stoer file in Bydefault in storage->app
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'description' => 'required',
            'tags' => 'required'
        ]);
        // $formFields['logo'] = 'sfs';
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // dd($formFields); 

         $listing->update($formFields);

        // Session::flash('message')
        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete Listing

    public function destroy(Listing $listing) {
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted succesfully!');
    }
}
