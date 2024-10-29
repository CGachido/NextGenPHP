<?php

namespace Mylog\Logger;

class FileLogger implements LoggerInterface
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function log(LogLevel $level, string $message, array $data): void
    {
        $logMessage = sprintf(
            "%s | %s: [%s] [%s]%s",
            date('Y-m-d H:i:s'),
            $level->value,
            $message,
            json_encode($data),
            PHP_EOL
        );
        file_put_contents($this->filePath, $logMessage, FILE_APPEND);
    }
}
