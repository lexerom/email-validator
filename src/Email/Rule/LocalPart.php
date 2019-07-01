<?php
declare(strict_types=1);

namespace lexerom\Email\Rule;

use lexerom\Email\Email;

class LocalPart implements RuleInterface
{
    public function isValid(Email $email): bool
    {
        $pattern = '/^[-._+0-9a-z]+$/i';

        $result = preg_match($pattern, $email->getLocalPart());
        return $result === 1;
    }

    /**
     * Get rule priority. For example, dns rule must run after localPart and domain part rules are executed.
     * @return int
     */
    public function getPriority(): int
    {
        return self::PRIORITY_LOCAL_PART;
    }
}