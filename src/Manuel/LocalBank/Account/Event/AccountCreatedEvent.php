<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account\Event;

use Manuel\LocalBank\Account\Account;
use Manuel\LocalBank\ValueObject\Money;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class AccountCreatedEvent
{
    /**
     * @var Account
     */
    private $account;

    /**
     * AccountCreatedEvent constructor.
     *
     * @param Account $account
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }
}