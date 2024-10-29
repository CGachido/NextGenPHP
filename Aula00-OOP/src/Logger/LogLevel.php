<?php

namespace Mylog\Logger;

enum LogLevel: string
{
    case log = 'log';
    case alert = 'alert';
    case danger = 'danger';
}
