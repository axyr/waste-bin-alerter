<?php

namespace Domain\Alerter;

use Domain\Alerter\Events\Alert;

class Alerter
{
    public function __construct(private readonly Event $event)
    {
    }

    public function emit(): void
    {
        event(new Alert($this->event));
    }
}
