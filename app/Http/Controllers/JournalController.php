<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $recentJournals = $user->journals()->orderBy('created_at', 'desc')->take(5)->get();
        
        // Data untuk grafik sentimen (7 entri terakhir)
        $chartData = $user->journals()
            ->select('created_at', 'mood_score')
            ->orderBy('created_at', 'desc')
            ->take(14)
            ->get()
            ->reverse()
            ->values();

        return view('dashboard', compact('recentJournals', 'chartData'));
    }

    public function index()
    {
        $journals = Auth::user()->journals()->orderBy('created_at', 'desc')->paginate(10);
        return view('journals.index', compact('journals'));
    }

    public function create()
    {
        return view('journals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'mood_score' => 'required|integer|min:1|max:5',
        ]);

        $request->user()->journals()->create($validated);

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil ditambahkan.');
    }

    public function show(Journal $journal)
    {
        $this->authorizeAccess($journal);
        return view('journals.show', compact('journal'));
    }

    public function edit(Journal $journal)
    {
        $this->authorizeAccess($journal);
        return view('journals.edit', compact('journal'));
    }

    public function update(Request $request, Journal $journal)
    {
        $this->authorizeAccess($journal);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'mood_score' => 'required|integer|min:1|max:5',
        ]);

        $journal->update($validated);

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil diperbarui.');
    }

    public function destroy(Journal $journal)
    {
        $this->authorizeAccess($journal);
        $journal->delete();
        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil dihapus.');
    }

    private function authorizeAccess(Journal $journal)
    {
        if ($journal->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
