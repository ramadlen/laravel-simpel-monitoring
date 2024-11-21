<?php

namespace App\Filament\Widgets;

use App\Models\Monitoring; // Pastikan menggunakan namespace yang benar untuk model Monitoring
use Filament\Widgets\ChartWidget;

class MonitoringsChart extends ChartWidget
{
    protected static ?string $heading = 'Monitoring Chart';
    
    // Inisialisasi filter dengan default 'today'
    public ?string $filter = 'today';

    protected function getData(): array
    {
        // Ambil filter yang aktif
        $activeFilter = $this->filter;

        // Tentukan query berdasarkan filter yang dipilih
        $query = Monitoring::selectRaw('MONTH(created_at) as month, SUM(unit) as total_kendala')
            ->groupBy('month');

        // Aplikasikan filter berdasarkan nilai filter yang aktif
        if ($activeFilter === 'today') {
            // Filter untuk hari ini
            $query->whereDate('created_at', now());
        } elseif ($activeFilter === 'last_week') {
            // Filter untuk minggu terakhir
            $query->whereBetween('created_at', [now()->subWeek(), now()]);
        } elseif ($activeFilter === 'this_month') {
            // Filter untuk bulan ini
            $query->whereMonth('created_at', now()->month);
        } elseif ($activeFilter === 'last_month') {
            // Filter untuk bulan lalu
            $query->whereMonth('created_at', now()->subMonth()->month);
        }

        // Ambil hasil query
        $monitoringData = $query->pluck('total_kendala', 'month')->toArray();

        // Persiapkan data untuk chart
        // Tambahkan data untuk bulan yang tidak ada datanya
        $totalKendalaPerBulan = [];
        foreach ([1, 2, 3, 4, 5, 6] as $bulan) {
            $totalKendalaPerBulan[] = $monitoringData[$bulan] ?? 0; // Jika tidak ada data, set 0
        }

        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], // Label sumbu X
            'datasets' => [
                [
                    'label' => 'Total Kendala', // Label untuk dataset
                    'data' => $totalKendalaPerBulan, // Data yang sudah diproses
                    'backgroundColor' => '#42A5F5',
                    'borderColor' => '#1E88E5',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Menentukan tipe chart sebagai bar chart
    }
}
