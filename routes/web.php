<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// All Listings  
// Route::get('/', function () {
//     return view('listings', [
//         'listings' => Listing::all()
//     ]);
// });

// Single Listings (Without using eloquent Model
// Route::get('/listings/{id}', function ($id) {
//     $listing = Listing::find($id);

//     if($listing) {
//         return view('listing', [
//             'listing' => $listing
//         ]);
//     } else {
//         abort('404');
//     }
// });

// Single Listings (With using eloquent Model

// Route::get('/listings/{listing}', function (Listing $listing) {
//     return view('listing', [
//         'listing' => $listing
//     ]);
// });

// ********* Call From controllers ********** //

// Common REsource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new Listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

// All Listings 
Route::get('/', [ListingController::class, 'index']);

// Show create form
Route::get('/listings/create', [ListingController::class, 'create']);

// Store Listing Data
Route::post('/listings', [ListingController::class, 'store']);

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

// Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update']);

// Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

//  Single Listings (With using eloquent Model
Route::get('/listings/{listing}', [ListingController::class, 'show']);


// Single Listings (Without using eloquent Model

// Route::get('/listings/{listing}', function (Listing $listing) {
//     return view('listings.show', [
//         'listing' => $listing
//     ]);
// });


//  ********************************************* //

// Show Register/ Create Form

Route::get('/register', [UserController::class, 'create']);