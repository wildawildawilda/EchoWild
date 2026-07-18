<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-100 leading-tight tracking-tight">
                    {{ __('Your Reflections') }}
                </h2>
                <p class="text-sm text-emerald-600 dark:text-emerald-400 mt-1 font-medium">Track your emotional journey over time</p>
            </div>
            <a href="{{ route('journals.create') }}" class="inline-flex items-center justify-center bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Journal
            </a>
        </div>
    </x-slot>

    <div class="py-12 relative overflow-hidden">
        <!-- Abstract Background Blobs -->
        <div class="absolute top-10 left-10 w-96 h-96 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-20 right-10 w-96 h-96 bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10">
            
            <!-- Sentiment Tracker Chart -->
            <div class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-white/20 dark:border-gray-700/50 transform transition-all duration-300 hover:shadow-emerald-500/10">
                <div class="p-8">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        Mood Patterns
                    </h3>
                    <div class="relative h-72 w-full">
                        <canvas id="sentimentChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Journals -->
            <div class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-white/20 dark:border-gray-700/50">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-200 dark:border-gray-800">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            Recent Journals
                        </h3>
                        <a href="{{ route('journals.index') }}" class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 transition-colors">View All &rarr;</a>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse($recentJournals as $journal)
                            <a href="{{ route('journals.show', $journal) }}" class="block p-5 rounded-2xl border border-gray-100 dark:border-gray-800 bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1 pr-4">
                                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $journal->title ?: 'Untitled' }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2 leading-relaxed">{{ Str::limit($journal->content, 120) }}</p>
                                    </div>
                                    <div class="flex flex-col items-end justify-between h-full space-y-4">
                                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 text-white font-bold text-lg shadow-md">
                                            @php
                                                $emojis = [1 => '😩', 2 => '🙁', 3 => '😐', 4 => '🙂', 5 => '😁'];
                                            @endphp
                                            {{ $emojis[$journal->mood_score] ?? '😐' }}
                                        </span>
                                        <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">{{ $journal->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-12">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-500 mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </div>
                                <p class="text-lg font-medium text-gray-600 dark:text-gray-400">No journals yet.</p>
                                <p class="text-sm text-gray-500 mt-1">Start recording your emotional journey today.</p>
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
            
            // Create gradient
            let gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(16, 185, 129, 0.4)'); // Emerald 500
            gradient.addColorStop(1, 'rgba(16, 185, 129, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Mood Score',
                        data: dataScores,
                        borderColor: '#10b981', // Emerald 500
                        backgroundColor: gradient,
                        borderWidth: 3,
                        tension: 0.5, // Smoother curves
                        fill: true,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#ffffff',
                        pointHoverBorderColor: '#10b981',
                        pointHoverBorderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        y: {
                            min: 0.5,
                            max: 5.5,
                            ticks: {
                                stepSize: 1,
                                font: { family: "'Outfit', sans-serif", size: 12 },
                                color: '#9ca3af',
                                callback: function(value) {
                                    if(!Number.isInteger(value)) return null;
                                    const moods = {1: '😩 Awful', 2: '🙁 Bad', 3: '😐 Okay', 4: '🙂 Good', 5: '😁 Awesome'};
                                    return moods[value];
                                }
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.1)',
                                borderDash: [5, 5]
                            },
                            border: { display: false }
                        },
                        x: {
                            ticks: {
                                font: { family: "'Outfit', sans-serif", size: 12 },
                                color: '#9ca3af',
                            },
                            grid: { display: false },
                            border: { display: false }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            titleFont: { family: "'Outfit', sans-serif", size: 13 },
                            bodyFont: { family: "'Outfit', sans-serif", size: 14, weight: 'bold' },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    const moods = {1: 'Awful', 2: 'Bad', 3: 'Okay', 4: 'Good', 5: 'Awesome'};
                                    return 'Mood: ' + moods[context.raw];
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
