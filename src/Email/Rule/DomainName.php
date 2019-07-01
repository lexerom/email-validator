<?php
declare(strict_types=1);

namespace lexerom\Email\Rule;

use lexerom\Email\Email;

class DomainName implements RuleInterface
{
    const DOMAIN_LENGTH_MAX = 255;
    const DOMAIN_LENGTH_MIN = 2;

    public function isValid(Email $email): bool
    {
        $domain = $email->getDomain();

        $domainLength = strlen($domain);

        if ($domainLength < self::DOMAIN_LENGTH_MIN || $domainLength > self::DOMAIN_LENGTH_MAX) {
            return false;
        }

        $pattern = '/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/i';
        $result = preg_match($pattern, $domain);
        return $result === 1;
    }

    /**
     * Get rule priority. For example, dns rule must run after localPart and domain part rules are executed.
     * @return int
     */
    public function getPriority(): int
    {
        return self::PRIORITY_DOMAIN_NAME;
    }
}