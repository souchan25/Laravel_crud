<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tickets.index');
});

Route::get('/about', function () {
    return view('about', [
        'members' => config('team.members', []),
    ]);
})->name('about');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'openCount' => Ticket::where('status', 'open')->count(),
        'inProgressCount' => Ticket::where('status', 'in-progress')->count(),
        'resolvedCount' => Ticket::where('status', 'resolved')->count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
});

require __DIR__.'/auth.php';
