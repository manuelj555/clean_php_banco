<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\ValueObject;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class Email
{
    /**
     * @var string
     */
    private $email;

    /**
     * Email constructor.
     *
     * @param string $email
     */
    public function __construct(string $email)
    {
        if (empty($email)){
            throw new \InvalidArgumentException("El email no puede estar vacio");
        }

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function __toString()
    {
        return $this->getEmail();
    }
}