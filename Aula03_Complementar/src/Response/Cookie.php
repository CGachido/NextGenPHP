<?php

namespace Headers\Response;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use InvalidArgumentException;

class Cookie
{
    protected array $params;

    public function __construct(
        protected string $cookieName,
        protected string $cookieValue,
        protected DateTimeImmutable $startDate = new DateTimeImmutable('now')
    ) {
        $this->cookieName = trim($cookieName);
        $this->cookieValue = trim($cookieValue);
        $this->setCookieValue();
    }

    protected function setCookieValue()
    {
        $cookieNameParts = \explode(" ", $this->cookieName);
        if (count($cookieNameParts) > 1) {
            throw new InvalidArgumentException("Cookie name cannot have spaces between provided: {$this->cookieName}");
        }
        if (\mb_detect_encoding($this->cookieName) !== 'ASCII') {
            throw new InvalidArgumentException("Cookie name can only be US ASCII");
        }
        $cookieValue = \urlencode($this->cookieValue);
        $this->params[] = "Set-Cookie: {$this->cookieName}={$cookieValue}";
    }

    public function setExpires(string $time)
    {
        $dateInterval = $this->startDate->add(DateInterval::createFromDateString($time));
        $formattedDate = $dateInterval->format('D, d M Y H:i:s \G\M\T');
        $this->params[] = "Expires={$formattedDate}";
    }

    public function getHeaderString()
    {
        return implode("; ", $this->params);
    }
}
