<?php
declare(strict_types=1);

namespace lexerom\Email\Rule;

use lexerom\Email\Email;

interface RuleInterface
{
    const PRIORITY_LOCAL_PART = 1;
    const PRIORITY_DOMAIN_NAME = 2;
    const PRIORITY_DNS = 4;
    /**
     *
     *
     * @param Email $email
     * @return bool
     */
    public function isValid(Email $email): bool;

    /**
     * Get rule priority. For example, dns rule must run after localPart and domain part rules are executed.
     * @return int
     */
    public function getPriority(): int;
}