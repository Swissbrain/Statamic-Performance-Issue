<?php

use App\Mail\RentalRequestMail;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\QuoteController;
use Statamic\Events\Event;

Route::get('suchen', \App\Http\Controllers\SearchController::class)->name('search.index');

Route::get('/jura/{slug}/{id}/offerte', [QuoteController::class, 'create'])->name('quote.create');

Route::prefix('/jura/offerte/')->where(['quote' => '[A-Za-z0-9]{32}'])->group(function() {
    Route::post('/', [QuoteController::class, 'store'])->name('quote.store');
    Route::get('/{quote}/confirmed', [QuoteController::class, 'confirmed'])->name('quote.confirmed');
});

Route::get('test', function() {
    $container = \Statamic\Facades\AssetContainer::find('test2');
    dd($container);
});