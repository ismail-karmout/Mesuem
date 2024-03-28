<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//admin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// subscriber
Route::get('/subscriber', [App\Http\Controllers\SubscriberUserController::class, 'index'])->name('subscriber');
// artist
Route::get('/artist', [App\Http\Controllers\ArtistUserController::class, 'index'])->name('artist');
// conferencier
Route::get('/conferencier', [App\Http\Controllers\ConferencierUserController::class, 'index'])->name('conferencier');


// abonnees
Route::get('/subscribers', [App\Http\Controllers\SubscribersController::class, 'index'])->name('subscribers.index');
//delete 
Route::delete('/subscribers/{id}', [App\Http\Controllers\SubscribersController::class, 'destroy'])->name('subscribers.destroy');
//restore
Route::post('/subscribers/restore/{id}', [App\Http\Controllers\SubscribersController::class, 'restore'])->name('subscribers.restore');

//artists 
Route::get('/artists', [App\Http\Controllers\ArtistsController::class, 'index'])->name('artists.index');
//store 
Route::post('/artists', [App\Http\Controllers\ArtistsController::class, 'store'])->name('artists.store');
//update
Route::put('/artists/{id}', [App\Http\Controllers\ArtistsController::class, 'update'])->name('artists.update');
//delete
Route::delete('/artists/{id}', [App\Http\Controllers\ArtistsController::class, 'destroy'])->name('artists.destroy');
//restore
Route::post('/artists/restore/{id}', [App\Http\Controllers\ArtistsController::class, 'restore'])->name('artists.restore');

//atworks 
Route::get('/artworks', [App\Http\Controllers\ArtworkController::class, 'index'])->name('artworks.index');
//store
Route::post('/artworks', [App\Http\Controllers\ArtworkController::class, 'store'])->name('artworks.store');
// update 
Route::put('/artworks/{id}', [App\Http\Controllers\ArtworkController::class, 'update'])->name('artworks.update');
//delete
Route::delete('/artworks/{id}', [App\Http\Controllers\ArtworkController::class, 'destroy'])->name('artworks.destroy');
//restore
Route::post('/artworks/restore/{id}', [App\Http\Controllers\ArtworkController::class, 'restore'])->name('artworks.restore');


//salles 
Route::get('/salles', [App\Http\Controllers\SalleController::class, 'index'])->name('salles.index');
//store
Route::post('/salles', [App\Http\Controllers\SalleController::class, 'store'])->name('salles.store');
//update
Route::put('/salles/{id}', [App\Http\Controllers\SalleController::class, 'update'])->name('salles.update');

//manifestations
Route::get('/manifestations', [App\Http\Controllers\ManifestationController::class, 'index'])->name('manifestations.index');
//store
Route::post('/manifestations', [App\Http\Controllers\ManifestationController::class, 'store'])->name('manifestations.store');
//update
Route::put('/manifestations/{id}', [App\Http\Controllers\ManifestationController::class, 'update'])->name('manifestations.update');
//delete
Route::delete('/manifestations/{id}', [App\Http\Controllers\ManifestationController::class, 'destroy'])->name('manifestations.destroy');
//detach salle
Route::post('/manifestations/{id}/detach', [App\Http\Controllers\ManifestationController::class, 'detachSalle'])->name('manifestations.detach');

//conferences
Route::get('/conferences', [App\Http\Controllers\ConferenceController::class, 'index'])->name('conferenciers.index');
//store
Route::post('/conferences', [App\Http\Controllers\ConferenceController::class, 'store'])->name('conferenciers.store');
//update
Route::put('/conferences/{id}', [App\Http\Controllers\ConferenceController::class, 'update'])->name('conferenciers.update');
// delete
Route::delete('/conferences/{id}', [App\Http\Controllers\ConferenceController::class, 'destroy'])->name('conferenciers.destroy');

// tarifs
Route::get('/tarifs', [App\Http\Controllers\TarifController::class, 'index'])->name('tarifs.index');
//store
Route::post('/tarifs', [App\Http\Controllers\TarifController::class, 'store'])->name('tarifs.store');
//update
Route::put('/tarifs/{id}', [App\Http\Controllers\TarifController::class, 'update'])->name('tarifs.update');
//delete
Route::delete('/tarifs/{id}', [App\Http\Controllers\TarifController::class, 'destroy'])->name('tarifs.destroy');

// reservations
Route::get('/reservations', [App\Http\Controllers\ReservationController::class, 'index'])->name('reservations.index');
//store
Route::post('/reservations', [App\Http\Controllers\ReservationController::class, 'store'])->name('reservations.store');
//delete
Route::delete('/reservations/{id}', [App\Http\Controllers\ReservationController::class, 'destroy'])->name('reservations.destroy');


//artist 
Route::get('/artist/list', [App\Http\Controllers\MuseumController::class, 'artists'])->name('artist.index');
//artworks
Route::get('/artworks/list', [App\Http\Controllers\MuseumController::class, 'artworks'])->name('oeuvre.index');
// visits
Route::get('/visits/list', [App\Http\Controllers\MuseumController::class, 'visits'])->name('visits.index');
// calendar
Route::get('/calendar', [App\Http\Controllers\MuseumController::class, 'calendar'])->name('calendar.index');

//profile 
Route::get('/profile', [App\Http\Controllers\MuseumController::class, 'profile'])->name('profile.index');
//update profile 
Route::put('/profile', [App\Http\Controllers\MuseumController::class, 'profileUpdate'])->name('profile.update');