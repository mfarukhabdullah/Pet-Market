<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Log;

class ProcessListingImageHash implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $listingImageId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $listingImageId)
    {
        $this->listingImageId = $listingImageId;
    }

    /**
     * Execute the job: generate image hash asynchronously to detect duplicate fraud
     */
    public function handle()
    {
        $image = ListingImage::find($this->listingImageId);
        if (!$image) {
            return;
        }

        // Generate MD5 or Perceptual hash for fraud comparison
        $filePath = public_path($image->image_url);
        if (file_exists($filePath)) {
            $hash = md5_file($filePath);
            $image->update(['phash' => $hash]);
            Log::info("Asynchronous Image Hash Computed for Image ID {$this->listingImageId}: {$hash}");
        }
    }
}
