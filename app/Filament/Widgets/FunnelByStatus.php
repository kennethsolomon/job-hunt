<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Filament\Widgets\ChartWidget;

class FunnelByStatus extends ChartWidget
{
    protected static ?int $sort = 2;
    protected ?string $heading = 'Pipeline by Status';

    public function getDescription(): ?string
    {
        return 'Visualize how your job applications progress through each pipeline stage';
    }

    protected function getData(): array
    {
        $counts = Application::where('user_id',auth()->id())
            ->selectRaw('status, count(*) as c')->groupBy('status')->pluck('c','status');

        $labels = ['prospect','applied','replied','interview','offer','accepted','rejected'];
        $data = array_map(fn($s) => $counts[$s] ?? 0, $labels);

        // Define beautiful colors for each status
        $colors = [
            '#3b82f6', // prospect - blue
            '#8b5cf6', // applied - purple
            '#06b6d4', // replied - cyan
            '#f59e0b', // interview - amber
            '#10b981', // offer - emerald
            '#22c55e', // accepted - green
            '#ef4444', // rejected - red
        ];

        return [
            'datasets' => [[
                'label' => 'Applications',
                'data' => $data,
                'backgroundColor' => $colors,
                'borderColor' => array_map(fn($color) => $color . '80', $colors), // Semi-transparent borders
                'borderWidth' => 2,
                'borderRadius' => 6,
                'hoverBorderWidth' => 3,
                'hoverBackgroundColor' => array_map(fn($color) => $color . 'DD', $colors), // Slightly more opaque on hover
            ]],
            'labels' => array_map('ucfirst', $labels),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // Changed to doughnut for better visual appeal
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'padding' => 20,
                        'usePointStyle' => true,
                        'font' => [
                            'size' => 12,
                            'weight' => '500'
                        ]
                    ]
                ],
                'tooltip' => [
                    'enabled' => true,
                    'backgroundColor' => 'rgba(0, 0, 0, 0.9)',
                    'titleColor' => '#ffffff',
                    'bodyColor' => '#ffffff',
                    'borderColor' => 'rgba(255, 255, 255, 0.2)',
                    'borderWidth' => 1,
                    'cornerRadius' => 12,
                    'displayColors' => true,
                    'titleFont' => [
                        'size' => 16,
                        'weight' => 'bold'
                    ],
                    'bodyFont' => [
                        'size' => 14,
                        'weight' => '500'
                    ],
                    'titleSpacing' => 8,
                    'bodySpacing' => 6,
                    'padding' => 12,
                    'caretSize' => 8,
                    'callbacks' => [
                        'title' => 'function(context) {
                            return context[0].label + " Status";
                        }',
                        'label' => 'function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.raw / total) * 100).toFixed(1);
                            const count = context.raw;
                            return [
                                "Count: " + count + " application" + (count === 1 ? "" : "s"),
                                "Percentage: " + percentage + "% of total"
                            ];
                        }',
                        'afterLabel' => 'function(context) {
                            const descriptions = {
                                "Prospect": "Companies you are interested in",
                                "Applied": "Applications submitted, awaiting response",
                                "Replied": "Companies that responded to you",
                                "Interview": "Interview scheduled or completed",
                                "Offer": "Job offer received",
                                "Accepted": "Offer accepted - congratulations!",
                                "Rejected": "Application declined"
                            };
                            return descriptions[context.label] || "";
                        }'
                    ]
                ]
            ],
            'cutout' => '50%', // For doughnut chart
            'elements' => [
                'arc' => [
                    'borderWidth' => 2,
                    'hoverBorderWidth' => 4,
                    'hoverOffset' => 8 // Makes the segment "pop out" on hover
                ]
            ],
            'interaction' => [
                'intersect' => true,
                'mode' => 'nearest'
            ],
            'animation' => [
                'animateRotate' => true,
                'animateScale' => true,
                'duration' => 1000
            ]
        ];
    }

    protected ?string $maxHeight = '250px';
    protected ?string $pollingInterval = '30s';
}
