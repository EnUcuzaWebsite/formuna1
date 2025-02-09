<?php

namespace App;

use App\Models\Report;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Reportable
{
    public function reports(): MorphMany
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function report($report): void
    {
        $this->reports()->create([
            'user_id' => auth()->id(),
            'report' => $report,
        ]);
    }

}
