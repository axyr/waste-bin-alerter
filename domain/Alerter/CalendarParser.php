<?php

namespace Domain\Alerter;

use Carbon\Carbon;
use ICal\ICal;

class CalendarParser
{
    private Carbon $date;

    public function __construct(private readonly ICal $calendar)
    {
        $this->date = now();
    }

    public function setFile(string $file): static
    {
        $this->calendar->initFile($file);

        return $this;
    }

    public function setDate(Carbon $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getFirstUpcomingEvent(): ?Event
    {
        $events = collect($this->calendar->events())->sortBy('dtstart');

        /** @var \ICal\Event $event */
        foreach ($events as $event) {
            $date = Carbon::parse($event->dtstart);
            if ($date > $this->date) {
                return new Event($date , $event->description);
            }
        }

        return null;
    }
}
