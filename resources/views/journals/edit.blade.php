<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Jurnal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="p-8">
                    <form action="{{ route('journals.update', $journal) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Judul (Opsional)</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Apa yang Anda pikirkan?" value="{{ old('title', $journal->title) }}">
                            @error('title')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <label for="content" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Isi Jurnal</label>
                            <textarea name="content" id="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" required>{{ old('content', $journal->content) }}</textarea>
                            @error('content')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mood / Sentiment Score -->
                        <div class="mb-8">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-3">Bagaimana perasaan Anda?</label>
                            <div class="flex items-center space-x-4" x-data="{ mood: {{ old('mood_score', $journal->mood_score) }} }">
                                <template x-for="i in 5" :key="i">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="mood_score" :value="i" class="hidden" x-model="mood">
                                        <div :class="{
                                            'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 border-emerald-500 shadow': mood == i,
                                            'bg-gray-50 dark:bg-gray-700 text-gray-400 border-transparent hover:bg-gray-100 dark:hover:bg-gray-600': mood != i
                                        }" class="h-12 w-12 rounded-full border-2 flex items-center justify-center text-xl transition-all duration-200">
                                            <span x-show="i == 1">😩</span>
                                            <span x-show="i == 2">🙁</span>
                                            <span x-show="i == 3">😐</span>
                                            <span x-show="i == 4">🙂</span>
                                            <span x-show="i == 5">😁</span>
                                        </div>
                                    </label>
                                </template>
                            </div>
                            @error('mood_score')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end">
                            <a href="{{ route('journals.show', $journal) }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Perbarui Jurnal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
