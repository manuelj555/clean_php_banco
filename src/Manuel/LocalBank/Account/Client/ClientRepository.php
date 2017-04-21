<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account\Client;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
interface ClientRepository
{
    public function add(Client $client);
    public function save(Client $client);
}