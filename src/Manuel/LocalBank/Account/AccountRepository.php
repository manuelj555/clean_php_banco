<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account;

use Manuel\LocalBank\ValueObject\EntityId;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
interface AccountRepository
{
    /**
     * @param EntityId $accountId
     * @return Account|null
     */
    public function findById(EntityId $accountId);
    public function findAll();
    public function add(Account $account);
    public function save(Account $account);
}