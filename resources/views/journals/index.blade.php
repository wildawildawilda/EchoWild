<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight">
                    {{ __('All Journals') }}
                </h2>
                <p class="text-sm text-emerald-600 dark:text-emerald-400 mt-1 font-medium">The footsteps of your emotional journey.</p>
            </div>
            <a href="{{ route('journals.create') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Journal
            </a>
        </div>
    </x-slot>

    <div class="py-12 relative overflow-hidden min-h-[60vh]">
        <!-- Abstract Background Blobs -->
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-40 -right-20 w-96 h-96 bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            @if(session('success'))
                <div class="mb-8 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-700 dark:text-emerald-300 flex items-center backdrop-blur-sm shadow-sm" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition>
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($journals as $journal)
                    <a href="{{ route('journals.show', $journal) }}" class="group block relative h-full bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl rounded-3xl border border-white/20 dark:border-gray-700/50 shadow-xl hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-300 transform hover:-translate-y-2 overflow-hidden flex flex-col">
                        <div class="p-8 flex-1">
                            <div class="flex justify-between items-start mb-6">
                                <span class="inline-flex items-center justify-center h-14 w-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 text-white font-bold text-3xl shadow-lg shadow-emerald-500/30 transform group-hover:scale-110 transition-transform duration-300">
                                    @php $emojis = [1 => '😩', 2 => '🙁', 3 => '😐', 4 => '🙂', 5 => '😁']; @endphp
                                    {{ $emojis[$journal->mood_score] ?? '😐' }}
                                </span>
                                <div class="text-right">
                                    <span class="block text-xs font-bold text-emerald-500 uppercase tracking-widest">{{ $journal->created_at->format('M d') }}</span>
                                    <span class="block text-xs font-medium text-gray-400 mt-1">{{ $journal->created_at->format('Y') }}</span>
                                </div>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors line-clamp-1">
                                {{ $journal->title ?: 'Untitled' }}
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed line-clamp-3">
                                {{ $journal->content }}
                            </p>
                        </div>
                        <div class="px-8 py-5 border-t border-gray-100/50 dark:border-gray-800/50 bg-gray-50/50 dark:bg-gray-800/30 flex items-center justify-between group-hover:bg-emerald-50/50 dark:group-hover:bg-emerald-900/20 transition-colors">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Read more</span>
                            <svg class="w-4 h-4 text-emerald-500 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full">
                        <div class="flex flex-col items-center justify-center p-16 bg-white/50 dark:bg-gray-900/50 backdrop-blur-md rounded-3xl border border-dashed border-gray-300 dark:border-gray-700 text-center">
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-500 mb-6">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-2">No journals yet</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-sm">You haven't written anything yet. Let's start documenting your days and feelings.</p>
                            <a href="{{ route('journals.create') }}" class="inline-flex items-center justify-center bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-3 rounded-xl text-sm font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                                Write Your First Journal
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $journals->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
