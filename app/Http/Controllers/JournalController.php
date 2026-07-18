<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class JournalController extends Controller
{
    public function analyze(Request $request)
    {
        $request->validate(['content' => 'required|string']);
        $text = $request->input('content');
        $apiKey = env('GEMINI_API_KEY');

        if (empty($apiKey)) {
            return response()->json(['error' => 'API Key belum dikonfigurasi.'], 500);
        }

        $prompt = "Analisis teks berikut yang merupakan entri jurnal keseharian. Tentukan skor suasana hati (mood score) dari 1 hingga 5, di mana 1 adalah sangat buruk (awful/sedih/marah), 2 adalah buruk, 3 adalah biasa saja (neutral), 4 adalah baik, dan 5 adalah sangat baik (awesome/sangat senang). Hanya balas dengan satu angka dari 1 sampai 5 tanpa teks tambahan apapun.\n\nTeks Jurnal: \"$text\"";

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $result = $data['candidates'][0]['content']['parts'][0]['text'] ?? '3';
            $score = (int) trim($result);
            // Ensure score is between 1 and 5
            $score = max(1, min(5, $score));
            return response()->json(['score' => $score]);
        }

        return response()->json(['error' => 'Gagal terhubung ke API AI.'], 500);
    }
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
