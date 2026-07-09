<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const isDarkMode = document.documentElement.classList.contains('dark');

            const primaryColor = isDarkMode ? '#e2ddca' : '#4A3A2A';
            const targetColor = isDarkMode ? '#475569' : '#D1D5DB';
            const gridColor = isDarkMode ? '#1e293b' : '#F3F4F6';
            const tickColor = isDarkMode ? '#94a3b8' : '#9CA3AF';

            const chartLabels = @json ($chartLabels);
            const chartDataValues = @json ($chartData);
            const chartTargetValues = @json ($chartTarget);

            const data = {
                labels: chartLabels,
                datasets: [
                    {
                        label: 'Pendapatan',
                        data: chartDataValues,
                        borderColor: primaryColor,
                        backgroundColor: primaryColor,
                        borderWidth: 3,
                        tension: 0.4,
                        pointBackgroundColor: primaryColor,
                        pointBorderColor: isDarkMode ? '#0f172a' : '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    },
                    {
                        label: 'Target',
                        data: chartTargetValues,
                        borderColor: targetColor,
                        backgroundColor: 'transparent',
                        borderWidth: 2,
                        borderDash: [4, 4],
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 0,
                    },
                ],
            };

            const config = {
                type: 'line',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            enabled: true,
                            backgroundColor: isDarkMode ? '#ffffff' : '#1F2937',
                            titleColor: isDarkMode ? '#0f172a' : '#ffffff',
                            bodyColor: isDarkMode ? '#0f172a' : '#ffffff',
                            padding: 12,
                            titleFont: { size: 13, family: 'Inter' },
                            bodyFont: { size: 13, family: 'Inter' },
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        let val = context.parsed.y;
                                        if (val >= 1000000) {
                                            label += 'Rp ' + val / 1000000 + ' Juta';
                                        } else if (val > 0) {
                                            label += 'Rp ' + val / 1000 + ' Ribu';
                                        } else {
                                            label += 'Rp 0';
                                        }
                                    }
                                    return label;
                                },
                            },
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            min: 0,
                            afterBuildTicks: function (axis) {
                                const filter = '{{ $filter }}';
                                let maxVal = axis.max || 0;
                                let customTicks = [];

                                if (filter === '7') {
                                    customTicks = [0, 100000, 250000, 500000, 1000000];
                                    while (customTicks[customTicks.length - 1] < maxVal) {
                                        customTicks.push(customTicks[customTicks.length - 1] + 500000);
                                    }
                                } else if (filter === '30') {
                                    customTicks = [0, 500000, 1000000, 3000000, 5000000];
                                    while (customTicks[customTicks.length - 1] < maxVal) {
                                        customTicks.push(customTicks[customTicks.length - 1] + 2000000);
                                    }
                                } else {
                                    customTicks = [
                                        0, 1000000, 3000000, 5000000, 10000000, 15000000, 20000000,
                                    ];
                                    while (customTicks[customTicks.length - 1] < maxVal) {
                                        customTicks.push(customTicks[customTicks.length - 1] + 5000000);
                                    }
                                }

                                axis.ticks = customTicks.map((v) => ({ value: v }));
                            },
                            ticks: {
                                color: tickColor,
                                font: {
                                    size: 11,
                                    family: 'Inter',
                                },
                                callback: function (value, index, values) {
                                    if (value === 0) return 'Rp 0';
                                    if (value >= 1000000) {
                                        return 'Rp ' + value / 1000000 + 'jt';
                                    } else {
                                        return 'Rp ' + value / 1000 + 'rb';
                                    }
                                },
                            },
                            border: {
                                display: false,
                            },
                            grid: {
                                color: gridColor,
                                drawBorder: false,
                            },
                        },
                        x: {
                            ticks: {
                                color: tickColor,
                                font: {
                                    size: 12,
                                    family: 'Inter',
                                },
                            },
                            border: {
                                display: false,
                            },
                            grid: {
                                display: false,
                            },
                        },
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                },
            };

            const myChart = new Chart(ctx, config);

            // Update chart colors on theme toggle
            const observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    if (mutation.attributeName === 'class') {
                        const isDark = document.documentElement.classList.contains('dark');
                        const newPrimary = isDark ? '#e2ddca' : '#4A3A2A';
                        const newTarget = isDark ? '#475569' : '#D1D5DB';
                        const newGrid = isDark ? '#1e293b' : '#F3F4F6';
                        const newTick = isDark ? '#94a3b8' : '#9CA3AF';
                        const newPointBorder = isDark ? '#0f172a' : '#ffffff';

                        myChart.data.datasets[0].borderColor = newPrimary;
                        myChart.data.datasets[0].backgroundColor = newPrimary;
                        myChart.data.datasets[0].pointBackgroundColor = newPrimary;
                        myChart.data.datasets[0].pointBorderColor = newPointBorder;
                        myChart.data.datasets[1].borderColor = newTarget;

                        myChart.options.scales.y.grid.color = newGrid;
                        myChart.options.scales.y.ticks.color = newTick;
                        myChart.options.scales.x.ticks.color = newTick;

                        myChart.options.plugins.tooltip.backgroundColor = isDark ? '#ffffff' : '#1F2937';
                        myChart.options.plugins.tooltip.titleColor = isDark ? '#0f172a' : '#ffffff';
                        myChart.options.plugins.tooltip.bodyColor = isDark ? '#0f172a' : '#ffffff';

                        myChart.update();
                    }
                });
            });
            observer.observe(document.documentElement, { attributes: true });
        });
    </script>