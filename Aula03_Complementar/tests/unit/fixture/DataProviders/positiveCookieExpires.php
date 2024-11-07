<?php

return [
    ['campo', 'my cookie value', '2023-01-31 00:00:00', '1 hour + 30 minutes', 'Set-Cookie: campo=my+cookie+value; Expires=Tue, 31 Jan 2023 01:30:00 GMT'],
    ['campo', 'my cookie value', '2023-01-31 00:00:00', '3 hour + 40 minutes', 'Set-Cookie: campo=my+cookie+value; Expires=Tue, 31 Jan 2023 03:40:00 GMT'],
    ['campo', 'my cookie value', '2023-01-31 00:00:00', '24 hours', 'Set-Cookie: campo=my+cookie+value; Expires=Wed, 01 Feb 2023 00:00:00 GMT'],
    ['campo', 'my cookie com mais espaço', '2023-01-31 00:00:00', '24 hours', 'Set-Cookie: campo=my+cookie+com+mais+espa%C3%A7o; Expires=Wed, 01 Feb 2023 00:00:00 GMT'],
];
