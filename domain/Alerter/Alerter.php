<?php

namespace Domain\Alerter;

use Domain\Alerter\Events\Alert;

readonly class Alerter
{
    public function __construct(private Event $event)
    {
    }

    public function emit(): void
    {
        event(new Alert($this->event));
    }
}
