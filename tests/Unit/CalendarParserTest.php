<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Domain\Alerter\CalendarParser;
use Tests\TestCase;

class CalendarParserTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testItParsesTheCalendar(string $now,string $expectedDate): void
    {
        Carbon::setTestNow($now);

        /** @var CalendarParser $parser */
        $parser = app(CalendarParser::class);
        $parser->setFile(base_path('tests/data/test.ical'));

        $event = $parser->getFirstUpcomingEvent();

        $this->assertEquals($expectedDate, $event->date()->format('Y-m-d'));
    }

    public static function dataProvider():array
    {
        return [
            [
                'now' =>'2023-08-20',
                'expectedDate' =>'2023-08-21',
            ],
            [
                'now' =>'2023-08-21',
                'expectedDate' =>'2023-08-24',
            ],
            [
                'now' =>'2023-08-25',
                'expectedDate' =>'2023-08-31',
            ],
            [
                'now' =>'2023-09-01',
                'expectedDate' =>'2023-09-07',
            ],
        ];
    }
}
