<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <a href="{{ route('journals.index') }}" class="inline-flex items-center text-sm font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300 mb-2 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to List
                </a>
                <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight">
                    {{ $journal->title ?: 'Untitled Journal' }}
                </h2>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('journals.edit', $journal) }}" class="inline-flex items-center justify-center bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200 dark:border-gray-700 hover:border-emerald-500 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-300 shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit
                </a>
                <form action="{{ route('journals.destroy', $journal) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this journal?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-900/50 hover:bg-red-500 hover:text-white px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-300 shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative overflow-hidden">
        <!-- Abstract Background Blobs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-white/20 dark:border-gray-700/50">
                <div class="p-8 sm:p-12">
                    
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 pb-8 border-b border-gray-100 dark:border-gray-800">
                        <div class="flex items-center mb-4 sm:mb-0">
                            <span class="inline-flex items-center justify-center h-16 w-16 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 text-white font-bold text-4xl shadow-lg shadow-emerald-500/30">
                                @php
                                    $emojis = [1 => '😩', 2 => '🙁', 3 => '😐', 4 => '🙂', 5 => '😁'];
                                @endphp
                                {{ $emojis[$journal->mood_score] ?? '😐' }}
                            </span>
                            <div class="ml-5">
                                <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Mood Score</p>
                                <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400">{{ $journal->mood_score }} / 5</p>
                            </div>
                        </div>
                        <div class="text-left sm:text-right">
                            <p class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Written On</p>
                            <p class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ $journal->created_at->format('d F Y') }}</p>
                            <p class="text-sm text-gray-400">{{ $journal->created_at->format('H:i') }}</p>
                        </div>
                    </div>

                    <div class="prose prose-lg dark:prose-invert prose-emerald max-w-none text-gray-700 dark:text-gray-300 leading-relaxed font-medium">
                        {!! nl2br(e($journal->content)) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
