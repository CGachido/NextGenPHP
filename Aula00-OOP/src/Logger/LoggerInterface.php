<?php

namespace Mylog\Logger;

interface LoggerInterface
{
    public function log(LogLevel $level, string $message, array $data): void;
}
