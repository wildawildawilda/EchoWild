<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $journal->title ?: 'Jurnal: ' . $journal->created_at->format('d M Y') }}
            </h2>
            <a href="{{ route('journals.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-100 dark:border-gray-700">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $journal->created_at->format('l, d F Y - H:i') }}
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Mood:</span>
                            @php
                                $emojis = [1 => '😩 (Sangat Buruk)', 2 => '🙁 (Buruk)', 3 => '😐 (Biasa Saja)', 4 => '🙂 (Baik)', 5 => '😁 (Sangat Baik)'];
                            @endphp
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-sm font-medium">
                                {{ $emojis[$journal->mood_score] ?? '😐' }}
                            </span>
                        </div>
                    </div>

                    <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed whitespace-pre-wrap">
                        {{ $journal->content }}
                    </div>

                    <div class="mt-12 flex justify-end space-x-4">
                        <a href="{{ route('journals.edit', $journal) }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit
                        </a>
                        <form action="{{ route('journals.destroy', $journal) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurnal ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
