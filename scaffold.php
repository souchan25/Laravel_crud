<?php

$ticketController = <<<EOT
<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        \$tickets = Ticket::with(['assignee', 'reporter'])->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        \$users = User::all();
        return view('tickets.create', compact('users'));
    }

    public function store(Request \$request)
    {
        \$validated = \$request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:open,in-progress,resolved',
            'priority' => 'required|string|in:low,medium,high',
            'type' => 'required|string|in:bug,feature',
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        \$validated['user_id'] = auth()->id();

        Ticket::create(\$validated);
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket \$ticket)
    {
        \$ticket->load(['reporter', 'assignee', 'comments.author']);
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket \$ticket)
    {
        \$users = User::all();
        return view('tickets.edit', compact('ticket', 'users'));
    }

    public function update(Request \$request, Ticket \$ticket)
    {
        \$validated = \$request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:open,in-progress,resolved',
            'priority' => 'required|string|in:low,medium,high',
            'type' => 'required|string|in:bug,feature',
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        \$ticket->update(\$validated);
        return redirect()->route('tickets.show', \$ticket)->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket \$ticket)
    {
        \$ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
EOT;

$commentController = <<<EOT
<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request \$request, Ticket \$ticket)
    {
        \$validated = \$request->validate([
            'content' => 'required|string',
        ]);

        \$ticket->comments()->create([
            'content' => \$validated['content'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tickets.show', \$ticket)->with('success', 'Comment added.');
    }
}
EOT;

\$routes = <<<EOT
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');
});

require __DIR__.'/auth.php';
EOT;

file_put_contents('app/Http/Controllers/TicketController.php', \$ticketController);
file_put_contents('app/Http/Controllers/CommentController.php', \$commentController);
file_put_contents('routes/web.php', \$routes);
