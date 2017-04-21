<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account;

use Manuel\LocalBank\Account\Client\Client;
use Manuel\LocalBank\Account\Event\AccountCreditEvent;
use Manuel\LocalBank\Account\Event\AccountDebitEvent;
use Manuel\LocalBank\Event\AbstractEvenStore;
use Manuel\LocalBank\ValueObject\EntityId;
use Manuel\LocalBank\ValueObject\Money;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class Account extends AbstractEvenStore
{
    /**
     * @var \Manuel\LocalBank\ValueObject\EntityId
     */
    private $accountId;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Money
     */
    private $balance;

    /**
     * @var boolean
     */
    private $locked = false;

    /**
     * Account constructor.
     *
     * @param EntityId $accountId
     * @param Client $client
     * @param Money $balance
     */
    public function __construct(EntityId $accountId, Client $client, Money $balance)
    {
        $this->accountId = $accountId;
        $this->client = $client;
        $this->balance = $balance;
    }

    /**
     * @return EntityId
     */
    public function getAccountId(): EntityId
    {
        return $this->accountId;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return Money
     */
    public function getBalance(): Money
    {
        return $this->balance;
    }

    /**
     * @param Money $balance
     */
    public function setBalance(Money $balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return boolean
     */
    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function lockAccount()
    {
        $this->locked = true;
    }

    public function unlockAccount()
    {
        $this->locked = false;
    }

    public function createDebit(Money $amount)
    {
        $originalBalance = $this->getBalance();
        $this->setBalance($this->getBalance()->deduct($amount));

        $this->pushEvent(new AccountDebitEvent(
            $this,
            $originalBalance,
            $amount
        ));
    }

    public function createCredit(Money $amount)
    {
        $originalBalance = $this->getBalance();
        $this->setBalance($this->getBalance()->add($amount));

        $this->pushEvent(new AccountCreditEvent(
            $this,
            $originalBalance,
            $amount
        ));
    }
}