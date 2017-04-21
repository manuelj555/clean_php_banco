<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Manuel\LocalBank\Account\Client\Client;
use Manuel\LocalBank\Account\Client\ClientRepository as Repository;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class ClientRepository extends EntityRepository implements Repository
{
    public function add(Client $client)
    {
        $this->_em->persist($client);
    }

    public function save(Client $client)
    {
        $this->_em->persist($client);
    }
}