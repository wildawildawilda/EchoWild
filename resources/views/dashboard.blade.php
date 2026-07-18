<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Refleksi Anda') }}
            </h2>
            <a href="{{ route('journals.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm transition-colors shadow-sm">
                + Tulis Jurnal
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Sentiment Tracker Chart -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Pola Suasana Hati (Tracker)</h3>
                    <div class="relative h-64 w-full">
                        <canvas id="sentimentChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Journals -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Jurnal Terbaru</h3>
                        <a href="{{ route('journals.index') }}" class="text-sm text-emerald-600 dark:text-emerald-400 hover:underline">Lihat Semua</a>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse($recentJournals as $journal)
                            <a href="{{ route('journals.show', $journal) }}" class="block p-4 rounded-lg border border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200">{{ $journal->title ?: 'Tanpa Judul' }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">{{ Str::limit($journal->content, 100) }}</p>
                                    </div>
                                    <div class="flex flex-col items-end space-y-2">
                                        <span class="text-xs text-gray-400">{{ $journal->created_at->diffForHumans() }}</span>
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 font-bold text-sm">
                                            {{ $journal->mood_score }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                                <p>Belum ada jurnal. Mulai tulis keseharian Anda.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);
            
            const labels = chartData.map(item => {
                const d = new Date(item.created_at);
                return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
            });
            const dataScores = chartData.map(item => item.mood_score);

            const ctx = document.getElementById('sentimentChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Mood Score',
                        data: dataScores,
                        borderColor: '#059669', // Emerald 600
                        backgroundColor: 'rgba(5, 150, 105, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#059669',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#059669'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            min: 1,
                            max: 5,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    const moods = {1: 'Awful', 2: 'Bad', 3: 'Okay', 4: 'Good', 5: 'Awesome'};
                                    return moods[value];
                                }
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
</x-app-layout>
