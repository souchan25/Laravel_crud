<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['assignee', 'reporter'])->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $users = User::all();
        return view('tickets.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:open,in-progress,resolved',
            'priority' => 'required|string|in:low,medium,high',
            'type' => 'required|string|in:bug,feature',
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        $validated['user_id'] = auth()->id();

        Ticket::create($validated);
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['reporter', 'assignee', 'comments.author']);
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $users = User::all();
        return view('tickets.edit', compact('ticket', 'users'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:open,in-progress,resolved',
            'priority' => 'required|string|in:low,medium,high',
            'type' => 'required|string|in:bug,feature',
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        $ticket->update($validated);
        return redirect()->route('tickets.show', $ticket)->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
