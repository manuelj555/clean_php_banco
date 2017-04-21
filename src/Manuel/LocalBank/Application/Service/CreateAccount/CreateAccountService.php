<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Application\Service\CreateAccount;

use Manuel\LocalBank\Account\Account;
use Manuel\LocalBank\Account\AccountRepository;
use Manuel\LocalBank\Account\Client\Client;
use Manuel\LocalBank\Account\Client\ClientRepository;
use Manuel\LocalBank\Account\Client\Event\ClientCreatedEvent;
use Manuel\LocalBank\Account\Event\AccountCreatedEvent;
use Manuel\LocalBank\Event\EventHandler;
use Manuel\LocalBank\ValueObject\Address;
use Manuel\LocalBank\ValueObject\Currency;
use Manuel\LocalBank\ValueObject\Email;
use Manuel\LocalBank\ValueObject\EntityId;
use Manuel\LocalBank\ValueObject\Money;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class CreateAccountService
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var AccountRepository
     */
    private $accountRepository;

    /**
     * @var EventHandler
     */
    private $eventHandler;

    /**
     * CreateAccountService constructor.
     *
     * @param ClientRepository $clientRepository
     * @param AccountRepository $accountRepository
     * @param EventHandler $eventHandler
     */
    public function __construct(
        ClientRepository $clientRepository,
        AccountRepository $accountRepository,
        EventHandler $eventHandler
    ) {
        $this->clientRepository = $clientRepository;
        $this->accountRepository = $accountRepository;
        $this->eventHandler = $eventHandler;
    }

    public function create(CreateAccountRequest $request)
    {
        $client = new Client(
            new EntityId(),
            new Email($request->email),
            new Address($request->address)
        );

        $account = new Account(
            new EntityId(),
            $client,
            new Money($request->initialAmount, new Currency(Currency::BS))
        );

        $this->clientRepository->add($client);
        $this->accountRepository->add($account);

        $this->eventHandler->dispatch(new ClientCreatedEvent($client));
        $this->eventHandler->dispatch(new AccountCreatedEvent($account));

        return $account->getAccountId();
    }
}