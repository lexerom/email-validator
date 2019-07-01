# email-validator

Example:
```
<?php

use lexerom\Email\Validator as EmailValidator;
use lexerom\Email\Rule\{Dns, LocalPart, DomainName};

$validator = new EmailValidator([
    new Dns(),
    new LocalPart(),
    new DomainName()
]);

$validator->validate('example@gmail.com');
```