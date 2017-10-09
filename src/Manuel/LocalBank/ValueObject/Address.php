<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\ValueObject;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class Address
{
    /**
     * @var string
     */
    private $address;

    /**
     * Address constructor.
     *
     * @param string $address
     */
    public function __construct(string $address)
    {
        if (empty($address)){
            throw new \InvalidArgumentException("La dirección no puede estar vacia");
        }

        $this->address = $address;
    }

    public function equals(Address $address): bool
    {
        return (string)$address === (string)$address;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    public function __toString(): string
    {
        return (string)$this->getAddress();
    }

}