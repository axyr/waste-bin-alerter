## Waste Calendar Alerter

Sets Phililp Hue bulbs in the color of the waste type that gets collected from Dutch Municipality The Hague.

Currently every day at 18:00.

Lights and Calendars can be configured in the environment file.


## Setup

(https://developers.meethue.com/develop/get-started-2/)[https://developers.meethue.com/develop/get-started-2/]

1. Find the ipadres of you Hue bridge
2. Obtain a username
3. Store both values into your `.env` file
4. Set the id of the lights you want to use for the alerts
5. Get your calendar from https://huisvuilkalender.denhaag.nl/
6. Store the url in your `.env` file
7. Set the laravel crontab to run the scheduled commands
