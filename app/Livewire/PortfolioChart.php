<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PortfolioChart extends Component
{
    public string $timespan = '6M'; // Default timespan
    public string $chartPath = '';
    public float $startValue = 0;
    public float $endValue = 0;

    protected $listeners = ['timespanChanged' => 'setTimespan'];

    public function mount()
    {
        $this->generateChartData();
    }

    public function setTimespan(string $newTimespan)
    {
        $this->timespan = $newTimespan;
        $this->generateChartData();
    }

    protected function generateChartData()
    {
        $user = Auth::user();
        $startDate = match($this->timespan) {
            '1M' => now()->subMonth(),
            '6M' => now()->subMonths(6),
            '1Y' => now()->subYear(),
            'ALL' => $user->created_at,
            default => now()->subMonths(6),
        };

        // Fetch relevant transactions
        $transactions = Transaction::where('user_id', $user->id)
            ->where('created_at', '>=', $startDate)
            ->orderBy('created_at')
            ->get(['balance_after', 'created_at']);
            
        if ($transactions->isEmpty()) {
            $this->chartPath = 'M0,150 L400,150'; // A flat line if no data
            $this->startValue = 0;
            $this->endValue = 0;
            return;
        }

        // We use the balance_after from the first relevant transaction as our starting point
        $initialBalance = Transaction::where('user_id', $user->id)
            ->where('created_at', '<', $startDate)
            ->orderBy('created_at', 'desc')
            ->first()?->balance_after ?? 0;

        $this->startValue = $transactions->first()->balance_after;
        $this->endValue = $transactions->last()->balance_after;
        
        // Convert the transaction data into SVG path coordinates
        $this->chartPath = $this->convertDataToSvgPath($transactions, $initialBalance);
    }

    protected function convertDataToSvgPath(Collection $data, float $initialBalance): string
    {
        if ($data->count() < 2) {
            return 'M0,75 L400,75'; // Draw a flat line if not enough data points
        }
        
        $maxBalance = $data->max('balance_after');
        $minBalance = $data->min('balance_after');

        // To prevent division by zero if all values are the same
        if ($maxBalance === $minBalance) {
             return 'M0,75 L400,75';
        }
        
        $svgWidth = 400;
        $svgHeight = 150;

        $path = 'M0,'.$this->scaleValue($data->first()->balance_after, $minBalance, $maxBalance, $svgHeight);

        foreach ($data as $index => $transaction) {
            $x = ($index / ($data->count() - 1)) * $svgWidth;
            $y = $this->scaleValue($transaction->balance_after, $minBalance, $maxBalance, $svgHeight);
            $path .= " L{$x},{$y}";
        }

        return $path;
    }

    protected function scaleValue($value, $min, $max, $scaleHeight)
    {
        // Invert Y-axis for SVG (0 is top)
        return $scaleHeight - (($value - $min) / ($max - $min)) * $scaleHeight;
    }

    public function render()
    {
        return view('livewire.portfolio-chart');
    }
}