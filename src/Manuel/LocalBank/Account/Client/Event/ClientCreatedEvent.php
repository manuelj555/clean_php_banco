<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account\Client\Event;

use Manuel\LocalBank\Account\Client\Client;
use Manuel\LocalBank\Event\Event;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class ClientCreatedEvent extends Event
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ClientCreatedEvent constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}