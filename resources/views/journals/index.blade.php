<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Riwayat Jurnal') }}
            </h2>
            <a href="{{ route('journals.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm transition-colors shadow-sm">
                + Tulis Jurnal
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 rounded-lg text-emerald-700 dark:text-emerald-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($journals as $journal)
                            <div class="flex flex-col justify-between p-5 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow relative group">
                                <div>
                                    <div class="flex justify-between items-start mb-3">
                                        <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">{{ $journal->title ?: 'Tanpa Judul' }}</h3>
                                        <div class="flex items-center space-x-1">
                                            @php
                                                $emojis = [1 => '😩', 2 => '🙁', 3 => '😐', 4 => '🙂', 5 => '😁'];
                                            @endphp
                                            <span class="text-xl" title="Mood: {{ $journal->mood_score }}">{{ $emojis[$journal->mood_score] ?? '😐' }}</span>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-3 mb-4">
                                        {{ $journal->content }}
                                    </p>
                                </div>
                                <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                                    <span class="text-xs text-gray-500">{{ $journal->created_at->format('d M Y, H:i') }}</span>
                                    <div class="flex space-x-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('journals.show', $journal) }}" class="text-emerald-600 hover:text-emerald-800 text-sm">Lihat</a>
                                        <form action="{{ route('journals.destroy', $journal) }}" method="POST" onsubmit="return confirm('Hapus jurnal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 text-gray-500">
                                <p class="text-lg">Belum ada jurnal yang ditulis.</p>
                                <a href="{{ route('journals.create') }}" class="text-emerald-600 hover:underline mt-2 inline-block">Tulis jurnal pertama Anda.</a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $journals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
