<?php
declare(strict_types=1);

namespace lexerom\Email;

use lexerom\Email\Rule\RuleInterface;

class Validator
{
    private $rules = [];

    /**
     * Validator constructor.
     * @param array $rules
     */
    public function __construct(array $rules = [])
    {
        foreach ($rules as $rule) {
            if ($rule instanceof RuleInterface) {
                $this->rules[] = $rule;
            }
        }

        $this->sortRulesByPriority();
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param RuleInterface $rule
     * @return self
     */
    public function addRule(RuleInterface $rule): self
    {
        //Do not check if this rule exists, because the same rule can have different settings
        //Basically 2 different rules in the end.
        $this->rules[] = $rule;

        $this->sortRulesByPriority();

        return $this;
    }

    /**
     *  Sort rules by priority, higher priority must be validated first
     * @return void
     */
    private function sortRulesByPriority(): void
    {
        usort($this->rules, function (RuleInterface $firstRule, RuleInterface $secondRule) {
            $firstPriority = $firstRule->getPriority();
            $secondPriority = $secondRule->getPriority();

            if ($firstPriority === $secondPriority) {
                return 0;
            }
            return ($firstPriority < $secondPriority) ? -1 : 1;
        });
    }

    /**
     * Iterate over rules
     *
     * @param mixed $input
     * @return bool
     */
    public function validate($input): bool
    {
        if (is_string($input)) {
            $email = new Email($input);
        } elseif (!($input instanceof Email)) {
            throw new \InvalidArgumentException("Input param must instance of string or Email.");
        } else {
            $email = $input;
        }
        foreach ($this->rules as $rule) {
            /**
             * @var RuleInterface $rule
             */

            if (!$rule->isValid($email)) {
                return false;
            }
        }

        return true;
    }
}
