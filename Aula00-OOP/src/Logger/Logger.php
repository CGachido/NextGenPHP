<?php

namespace Mylog\Logger;

class Logger
{
    public function __construct(private LoggerInterface $fileLogger) {}

    public function log(LogLevel $level, string $message, array $data): void
    {
        $this->fileLogger->log($level, $message, $data);
    }
}
