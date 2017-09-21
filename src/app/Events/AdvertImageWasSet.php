<?php

namespace App\Events;

use App\Advert;
use Illuminate\Queue\SerializesModels;

class AdvertImageWasSet extends Event
{
    use SerializesModels;
    /**
     * @var Advert
     */
    public $advert;

    /**
     * Create a new event instance.
     *
     * @param Advert $advert
     */
    public function __construct(Advert $advert)
    {
        $this->advert = $advert;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
