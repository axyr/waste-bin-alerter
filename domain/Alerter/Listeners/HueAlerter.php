<?php

namespace Domain\Alerter\Listeners;

use Domain\Alerter\Events\Alert;
use Phue\Client;
use Phue\Light;
use Spatie\Color\Hex;
use Spatie\Color\Rgb;

class HueAlerter
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(config('alerter.bridge_ip'), config('alerter.bridge_username'));
    }

    public function handle(Alert $alert): void
    {
        $rgb = $this->getRGB($alert);

        foreach ($this->client->getLights() as $light) {
            if ($this->isAlertable($light)) {
                $light->setOn()->setRGB($rgb->red(), $rgb->green(), $rgb->blue());
            }
        }
    }

    private function isAlertable(Light $light): bool
    {
        return in_array((string)$light->getId(), (array)config('alerter.lights'), true);
    }

    private function getRGB(Alert $alert): Rgb
    {
        $type = $alert->event->type();
        $color = config("alerter.alerts.{$type}");
        $hex = config("alerter.colors.{$color}");

        return Hex::fromString($hex)->toRgb();
    }
}
