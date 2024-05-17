<?php
namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Position;

class EmployeesChart extends Chart
{
    protected $chart;

    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->chart = new \ArielMejiaDev\LarapexCharts\BarChart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $positions = Position::withCount('employees')->get();
        $positionsLabels = $positions->pluck('name')->toArray();
        $employeesCount = $positions->pluck('employees_count')->toArray();

        return $this->chart->barChart()
            ->setTitle('Posisi')
            ->setSubtitle('Posisi dengan Jumlah Karyawan Terbanyak')
            ->addData('Jumlah Karyawan', $employeesCount)
            ->setXAxis($positionsLabels);
    }
}


