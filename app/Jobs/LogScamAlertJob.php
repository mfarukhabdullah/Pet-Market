<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Report;
use Illuminate\Support\Facades\Log;

class LogScamAlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $sellerId;
    protected $reason;
    protected $snippet;

    /**
     * Create a new job instance.
     */
    public function __construct(int $sellerId, string $reason, string $snippet)
    {
        $this->sellerId = $sellerId;
        $this->reason = $reason;
        $this->snippet = $snippet;
    }

    /**
     * Execute the job: register a security incident in reports table asynchronously
     */
    public function handle()
    {
        Report::create([
            'seller_id' => $this->sellerId,
            'reason' => 'Automated Scam Shield Trigger: ' . $this->reason,
            'details' => 'Flagged message snippet: ' . substr($this->snippet, 0, 500),
            'status' => 'pending',
        ]);

        Log::warning("Automated Scam Alert queued and registered for User ID {$this->sellerId}: {$this->reason}");
    }
}
