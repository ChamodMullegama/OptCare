<?php

use App\Http\Controllers\AdminArea\AdminController;
use App\Http\Controllers\AdminArea\GalleryController;
use App\Http\Controllers\AdminArea\ServiceController;
use App\Http\Controllers\OCTController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('AdminArea.Pages.Dashboard.index');
// });


 Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');


Route::prefix('oct-analysis')->group(function () {
    Route::get('/', [OCTController::class, 'showUploadForm'])->name('oct.upload');
    Route::post('/analyze', [OCTController::class, 'uploadAndPredict'])->name('oct.analyze');
});


Route::prefix('gallery')->group(function () {
    Route::get('/all', [GalleryController::class, "All"])->name('gallery.all');
    Route::post('/add', [GalleryController::class, 'Add'])->name('gallery.add');
    Route::post('/delete', [GalleryController::class, 'Delete'])->name('gallery.delete');
    Route::post('/update', [GalleryController::class, 'Update'])->name('gallery.update');
});

Route::prefix('service')->group(function () {
    Route::get('/all', [ServiceController::class, "All"])->name('service.all');
    Route::post('/add', [ServiceController::class, 'Add'])->name('service.add');
    Route::post('/delete', [ServiceController::class, 'Delete'])->name('service.delete');
    Route::post('/update', [ServiceController::class, 'Update'])->name('service.update');

    Route::post('/serviceImageAdd', [ServiceController::class, 'ServiceImageAdd'])->name('Service.serviceImageAdd');
    Route::get('/viewServiceImageAll/{serviceId}', [ServiceController::class, "ViewServiceImageAll"])->name('Service.viewServiceImageAll');
    Route::post('/viewServiceImageDelete', [ServiceController::class, 'ViewServiceImageDelete'])->name('Service.viewServiceImageDelete');
    Route::get('/isPrimary/{id}', [ServiceController::class, 'IsPrimary'])->name('Service.isPrimary');

});
