<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight">
            {{ __('Edit Journal') }}
        </h2>
    </x-slot>

    <div class="py-12 relative overflow-hidden">
        <!-- Abstract Background Blobs -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-0 w-72 h-72 bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-white/20 dark:border-gray-700/50">
                <div class="p-8 sm:p-12" x-data="journalForm()">
                    <form action="{{ route('journals.update', $journal) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-8">
                            <label for="title" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">Title (Optional)</label>
                            <input type="text" name="title" id="title" class="block w-full rounded-xl border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm text-gray-900 dark:text-gray-100 shadow-inner focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 transition-all duration-300 sm:text-lg px-4 py-3" placeholder="Today's moment..." value="{{ old('title', $journal->title) }}">
                            @error('title')
                                <p class="text-sm text-red-500 mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-8">
                            <label for="content" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">Journal Content</label>
                            <textarea x-model="content" name="content" id="content" rows="12" class="block w-full rounded-xl border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm text-gray-900 dark:text-gray-100 shadow-inner focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 transition-all duration-300 sm:text-base px-4 py-4 resize-none leading-relaxed" required>{{ old('content', $journal->content) }}</textarea>
                            @error('content')
                                <p class="text-sm text-red-500 mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mood / Sentiment Score with AI Button -->
                        <div class="mb-10 bg-gray-50/50 dark:bg-gray-800/30 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                            <div class="mb-4">
                                <label class="block font-semibold text-base text-gray-800 dark:text-gray-200">How are you feeling?</label>
                            </div>

                            <div class="flex items-center justify-between sm:justify-start sm:space-x-6">
                                <template x-for="i in 5" :key="i">
                                    <label class="cursor-pointer group">
                                        <input type="radio" name="mood_score" :value="i" class="hidden" x-model="mood">
                                        <div :class="{
                                            'bg-gradient-to-br from-emerald-400 to-teal-500 text-white shadow-emerald-500/30 shadow-lg scale-110 border-transparent': mood == i,
                                            'bg-white dark:bg-gray-800 text-gray-400 border-gray-200 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700': mood != i
                                        }" class="h-14 w-14 sm:h-16 sm:w-16 rounded-2xl border-2 flex items-center justify-center text-2xl sm:text-3xl transition-all duration-300 transform group-hover:-translate-y-1">
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
                                <p class="text-sm text-red-500 mt-3 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('journals.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 font-medium text-sm transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-xl font-bold text-sm tracking-wide hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                Update Journal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function journalForm() {
            return {
                content: @json(old('content', $journal->content)),
                mood: {{ old('mood_score', $journal->mood_score) }}
            }
        }
    </script>
</x-app-layout>
