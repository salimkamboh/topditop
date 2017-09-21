<?php

namespace App\Listeners;

use App\Events\AdvertImageWasSet;
use App\Services\CraftarService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncAdvertToCraftar
{
    /**
     * @var CraftarService
     */
    private $craftarService;

    /**
     * Create the event listener.
     *
     * @param CraftarService $craftarService
     */
    public function __construct(CraftarService $craftarService)
    {
        $this->craftarService = $craftarService;
    }

    /**
     * Handle the event.
     *
     * @param  AdvertImageWasSet $event
     * @return void
     */
    public function handle(AdvertImageWasSet $event)
    {
        $advert = $event->advert;

        $this->craftarService->syncOne($advert);
    }
}
