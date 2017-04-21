<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Manuel\LocalBank\Account\Operation\Transaction;
use Manuel\LocalBank\Account\Operation\TransactionRepository as Repository;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class TransactionRepository extends EntityRepository implements Repository
{

    public function add(Transaction $transaction)
    {
        $this->_em->persist($transaction);
    }
}