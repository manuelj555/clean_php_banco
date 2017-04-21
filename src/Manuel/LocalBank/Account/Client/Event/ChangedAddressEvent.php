<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account\Client\Event;

use Manuel\LocalBank\Account\Client\Client;
use Manuel\LocalBank\Event\Event;
use Manuel\LocalBank\ValueObject\Address;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class ChangedAddressEvent extends Event
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Address
     */
    private $originalAddress;

    /**
     * ChangedAddressEvent constructor.
     *
     * @param Client $client
     * @param Address $originalAddress
     */
    public function __construct(Client $client, Address $originalAddress)
    {
        $this->client = $client;
        $this->originalAddress = $originalAddress;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return Address
     */
    public function getOriginalAddress(): Address
    {
        return $this->originalAddress;
    }
}