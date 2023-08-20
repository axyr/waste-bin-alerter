<?php

namespace Domain\Alerter\Events;

use Domain\Alerter\Event;

class Alert
{
    public function __construct(
        public Event $event,
    ) {
    }
}
