<?php
declare(strict_types=1);

namespace lexerom\Email\Rule;

use lexerom\Email\Email;

class Dns implements RuleInterface
{
    public function isValid(Email $email): bool
    {
        $domain = $email->getDomain();

        if (checkdnsrr($domain . '.', 'MX')) {
            $mxRecords = dns_get_record($domain . '.', DNS_MX);
            if ($mxRecords !== false && count($mxRecords) > 0) {
                return true;
            }
        }

        if (checkdnsrr($domain . '.', 'A')) {
            $aRecords = dns_get_record($domain . '.', DNS_A);
            if ($aRecords !== false && count($aRecords) > 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get rule priority. For example, dns rule must run after localPart and domain part rules are executed.
     * @return int
     */
    public function getPriority(): int
    {
        return self::PRIORITY_DNS;
    }
}