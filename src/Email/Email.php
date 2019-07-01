<?php
declare(strict_types=1);

namespace lexerom\Email;

class Email
{
    /**
     * @var string
     */
    private $localPart;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $email;

    /**
     * Email constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->setEmail($email);
        $this->parse($this->email);
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getLocalPart(): string
    {
        return $this->localPart;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Parse $email for local and domain parts
     *
     * @param string $email
     */
    private function parse(string $email): void
    {
        $parts = explode('@', $email);

        if (count($parts) !== 2) {
            throw new \InvalidArgumentException(sprintf("Invalid email provided: %s", $email));
        }

        list($this->localPart, $this->domain) = $parts;
    }
}