<?php

namespace App\LogFormatters;

use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;

class LogFormatter
{
    public function __invoke(Logger $logger): void
    {
        foreach ($logger->getHandlers() as $handler) {
            $formatter = new LineFormatter("%message%\n", null, false, true);
            $formatter->includeStacktraces(false);
            $handler->setFormatter($formatter);
        }
    }

    protected function formatter()
    {
        return tap(new LineFormatter("%message%"), function ($formatter) {
            $formatter->includeStacktraces(false);
        });
    }

}
