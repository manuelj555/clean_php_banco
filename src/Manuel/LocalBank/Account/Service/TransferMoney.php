<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account\Service;

use Manuel\LocalBank\Account\Account;
use Manuel\LocalBank\Account\AccountRepository;
use Manuel\LocalBank\Account\Exception\LockedAccountException;
use Manuel\LocalBank\Account\Operation\Transaction;
use Manuel\LocalBank\Account\Operation\TransactionRepository;
use Manuel\LocalBank\Event\EventHandler;
use Manuel\LocalBank\ValueObject\EntityId;
use Manuel\LocalBank\ValueObject\Money;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class TransferMoney
{
    /**
     * @var AccountRepository
     */
    private $accountRepository;

    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * @var EventHandler
     */
    private $eventHandler;

    /**
     * TransferMoney constructor.
     *
     * @param AccountRepository $accountRepository
     * @param TransactionRepository $transactionRepository
     * @param EventHandler $eventHandler
     */
    public function __construct(
        AccountRepository $accountRepository,
        TransactionRepository $transactionRepository,
        EventHandler $eventHandler
    ) {
        $this->accountRepository = $accountRepository;
        $this->transactionRepository = $transactionRepository;
        $this->eventHandler = $eventHandler;
    }

    public function transfer(Account $from, Account $to, Money $amount)
    {
        if ($from->isLocked()) {
            throw new LockedAccountException("The account \"from\" is locked");
        }

        if ($to->isLocked()) {
            throw new LockedAccountException("The account \"to\" is locked");
        }

        $from->createDebit($amount);
        $to->createCredit($amount);

        $transaction = new Transaction(
            new EntityId(),
            $from,
            $to,
            $amount,
            Transaction::TYPE_TRANSFER,
            'Transfer'
        );

        $this->accountRepository->save($from);
        $this->accountRepository->save($to);
        $this->transactionRepository->add($transaction);

        $this->eventHandler->commitEvents($from);
        $this->eventHandler->commitEvents($to);
        $this->eventHandler->commitEvents($transaction);

        return $transaction;
    }
}