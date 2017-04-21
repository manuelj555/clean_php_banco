<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
interface AccountRepository
{
    public function add(Account $account);
    public function save(Account $account);
}