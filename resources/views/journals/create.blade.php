<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight">
            {{ __('Tulis Jurnal Baru') }}
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
                    <form action="{{ route('journals.store') }}" method="POST">
                        @csrf

                        <!-- Title -->
                        <div class="mb-8">
                            <label for="title" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">Judul (Opsional)</label>
                            <input type="text" name="title" id="title" class="block w-full rounded-xl border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm text-gray-900 dark:text-gray-100 shadow-inner focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 transition-all duration-300 sm:text-lg px-4 py-3" placeholder="Momen hari ini..." value="{{ old('title') }}">
                            @error('title')
                                <p class="text-sm text-red-500 mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-8">
                            <label for="content" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">Isi Jurnal</label>
                            <textarea x-model="content" name="content" id="content" rows="12" class="block w-full rounded-xl border-gray-200 dark:border-gray-700 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm text-gray-900 dark:text-gray-100 shadow-inner focus:border-emerald-500 focus:ring focus:ring-emerald-500/20 transition-all duration-300 sm:text-base px-4 py-4 resize-none leading-relaxed" placeholder="Tuangkan pikiran dan perasaan Anda di sini..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-sm text-red-500 mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mood / Sentiment Score with AI Button -->
                        <div class="mb-10 bg-gray-50/50 dark:bg-gray-800/30 rounded-2xl p-6 border border-gray-100 dark:border-gray-700/50">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                                <label class="block font-semibold text-base text-gray-800 dark:text-gray-200">Bagaimana perasaan Anda?</label>
                                <button type="button" @click="analyzeSentiment" :disabled="isAnalyzing || content.trim() === ''" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-lg shadow hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-show="!isAnalyzing" class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        Analisis Otomatis (AI)
                                    </span>
                                    <span x-show="isAnalyzing" class="flex items-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        Memproses...
                                    </span>
                                </button>
                            </div>
                            
                            <p x-show="aiError" x-text="aiError" class="text-sm text-red-500 mb-4 font-medium" style="display: none;"></p>

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
                            <a href="{{ route('dashboard') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 font-medium text-sm transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-xl font-bold text-sm tracking-wide hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                Simpan Jurnal
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
                content: @json(old('content', '')),
                mood: {{ old('mood_score', 3) }},
                isAnalyzing: false,
                aiError: null,
                async analyzeSentiment() {
                    if (!this.content.trim()) return;
                    this.isAnalyzing = true;
                    this.aiError = null;

                    try {
                        const response = await fetch('{{ route('journals.analyze') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ content: this.content })
                        });

                        const data = await response.json();
                        
                        if (response.ok) {
                            this.mood = data.score;
                        } else {
                            this.aiError = data.error || 'Terjadi kesalahan saat memanggil AI.';
                        }
                    } catch (error) {
                        this.aiError = 'Gagal terhubung ke server.';
                    } finally {
                        this.isAnalyzing = false;
                    }
                }
            }
        }
    </script>
</x-app-layout>
