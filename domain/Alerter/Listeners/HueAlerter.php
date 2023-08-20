<?php

namespace Domain\Alerter\Listeners;

use Domain\Alerter\Events\Alert;
use Phue\Client;
use Spatie\Color\Hex;
use Spatie\Color\Rgb;

class HueAlerter
{
    public function handle(Alert $alert): void
    {
        $rgb = $this->getRGB($alert);

        $client = new Client(config('alerter.bridge_ip'), config('alerter.bridge_username'));

        foreach ($client->getLights() as $light) {
            if (in_array((string)$light->getId(), (array)config('alerter.lights'), true)) {
                $light->setOn();
                $light->setRGB($rgb->red(), $rgb->green(), $rgb->blue());
            }
        }
    }

    private function getRGB(Alert $alert): Rgb
    {
        $type = $alert->event->type();
        $color = config("alerter.alerts.{$type}");
        $hex = config("alerter.colors.{$color}");

        return Hex::fromString($hex)->toRgb();
    }
}
