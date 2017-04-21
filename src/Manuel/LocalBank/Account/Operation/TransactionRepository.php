<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account\Operation;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
interface TransactionRepository
{
    public function add(Transaction $transaction);
}