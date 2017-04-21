<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Manuel\LocalBank\Account\Account;
use Manuel\LocalBank\Account\AccountRepository as Repository;
use Manuel\LocalBank\ValueObject\EntityId;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class AccountRepository extends EntityRepository implements Repository
{

    public function add(Account $account)
    {
        $this->_em->persist($account);
    }

    public function save(Account $account)
    {
        $this->_em->persist($account);
    }

    public function findById(EntityId $accountId)
    {
        return $this->_em->find(Account::class, $accountId->getId());
    }
}