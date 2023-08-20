<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Domain\Alerter\Alerter;
use Domain\Alerter\CalendarParser;
use Domain\Alerter\Event;
use Domain\Alerter\Events\Alert;
use Illuminate\Console\Command;

class EventAlertCommand extends Command
{
    protected $signature = 'event:alert
        {--date= : custom date to get the next event for}
        {--calendar= : custom calendar ate to get the next event for}
        {--dryrun : don\'t emit the alert}
    ';

    protected $description = 'Alert the first upcoming event';

    private CalendarParser $parser;

    public function __construct(CalendarParser $parser)
    {
        $this->parser = $parser;

        parent::__construct();
    }

    public function handle(): int
    {
        $this->checkAlerts();

        return $this->isolatedExitCode;
    }

    private function checkAlerts(): void
    {
        $this->initializeCalendar();

        if ($event = $this->parser->getFirstUpcomingEvent()) {
            $this->handleAlert($event);
        } else {
            $this->line('No upcoming event');
        }
    }

    private function initializeCalendar(): void
    {
        $this->parser
            ->setFile($this->calendar())
            ->setDate($this->date());
    }

    private function handleAlert(Event $event): void
    {
        $this->info($event->date()->format('Y-m-d') . ' : ' . $event->type());

        if ( ! $this->option('dryrun')) {
            event(new Alert($event));
        }
    }

    private function date(): Carbon
    {
        return $this->option('date') ? Carbon::parse($this->option('date')) : now();
    }

    private function calendar(): string
    {
        return $this->option('calendar') ?: config('alerter.calendar');
    }

}
