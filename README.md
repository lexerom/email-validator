# email-validator

Example:
```
<?php

use lexerom\Email\Validator as EmailValidator;
use lexerom\Email\Rule\{Dns, LocalPart, Domain};

$validator = new EmailValidator([
    new Dns(),
    new LocalPart(),
    new Domain()
]);`

$validator->validate('example@gmail.com');
```