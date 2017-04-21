<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account\Client;

use Manuel\LocalBank\ValueObject\Address;
use Manuel\LocalBank\ValueObject\Email;
use Manuel\LocalBank\ValueObject\EntityId;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class Client
{
    /**
     * @var EntityId
     */
    private $id;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var Address
     */
    private $address;

    /**
     * Client constructor.
     *
     * @param EntityId $id
     * @param Email $email
     * @param Address $address
     */
    public function __construct(EntityId $id, Email $email, Address $address)
    {
        $this->id = $id;
        $this->email = $email;
        $this->address = $address;
    }

    /**
     * @return EntityId
     */
    public function getId(): EntityId
    {
        return $this->id;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Email $email
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }
}