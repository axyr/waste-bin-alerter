<?php

namespace Domain\Alerter;

use Carbon\Carbon;

readonly class Event
{

    public function __construct(
        private Carbon $date,
        private string $type,
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
