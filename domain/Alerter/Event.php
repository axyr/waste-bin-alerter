<?php

namespace Domain\Alerter;

use Carbon\Carbon;

class Event
{
    public function __construct(
        private readonly Carbon $date,
        private readonly string $type,
    ) {
    }

    public function date(): Carbon
    {
        return $this->date;
    }

    public function type(): string
    {
        return strtolower($this->type);
    }
}
