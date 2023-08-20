<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Domain\Alerter\Alerter;
use Domain\Alerter\CalendarParser;
use Domain\Alerter\Events\Alert;
use Domain\Alerter\Listeners\HueAlerter;
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
        if($this->shouldCheckAlerts()) {
            $this->checkAlerts();
        }

        return $this->isolatedExitCode;
    }

    public function shouldCheckAlerts(): bool
    {
        return true;
        $date = $this->date();

        return $date->isSaturday() || $date->isSunday() || $date->isWednesday();
    }

    private function checkAlerts():void
    {
        $this->initializeCalendar();

        if ($event = $this->parser->getFirstUpcomingEvent()) {
            $date = $event->date()->format('Y-m-d');
            $type = $event->type();
            $this->info("{$date} : {$type}");

            if(!$this->option('dryrun')) {
                $listener = new HueAlerter();
                $listener->handle(new Alert($event));
                // (new Alerter($event))->emit();
            }
        } else {
            $this->line('No upcoming event');
        }
    }

    private function initializeCalendar(): void
    {
        $this->parser->setFile($this->calendar());
        $this->parser->setDate($this->date());
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
