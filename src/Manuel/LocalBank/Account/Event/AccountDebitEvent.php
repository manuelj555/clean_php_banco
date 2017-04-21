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
class AccountDebitEvent
{
    /**
     * @var Account
     */
    private $account;

    /**
     * @var Money
     */
    private $originalBalance;

    /**
     * @var Money
     */
    private $amount;

    /**
     * AccountDebitEvent constructor.
     *
     * @param Account $account
     * @param Money $originalBalance
     * @param Money $amount
     */
    public function __construct(Account $account, Money $originalBalance, Money $amount)
    {
        $this->account = $account;
        $this->originalBalance = $originalBalance;
        $this->amount = $amount;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @return Money
     */
    public function getOriginalBalance(): Money
    {
        return $this->originalBalance;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }
}