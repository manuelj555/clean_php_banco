<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account\Operation;

use Manuel\LocalBank\Account\Account;
use Manuel\LocalBank\Event\AbstractEvenStore;
use Manuel\LocalBank\ValueObject\EntityId;
use Manuel\LocalBank\ValueObject\Money;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class Transaction extends AbstractEvenStore
{
    const TYPE_TRANSFER = 'transfer';
    const TYPE_DEBIT = 'debit';
    const TYPE_CREDIT = 'credit';

    /**
     * @var EntityId
     */
    private $id;

    /**
     * @var Account
     */
    private $account;

    /**
     * @var Account
     */
    private $target;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * Transaction constructor.
     *
     * @param EntityId $id
     * @param Account $account
     * @param Account $target
     * @param Money $amount
     * @param string $type
     * @param string $description
     */
    public function __construct(
        EntityId $id,
        Account $account,
        Account $target,
        Money $amount,
        $type,
        $description
    ) {
        $this->id = $id;
        $this->account = $account;
        $this->target = $target;
        $this->amount = $amount;
        $this->type = $type;
        $this->description = $description;
    }

    /**
     * @return EntityId
     */
    public function getId(): EntityId
    {
        return $this->id;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @return Account
     */
    public function getTarget(): Account
    {
        return $this->target;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}