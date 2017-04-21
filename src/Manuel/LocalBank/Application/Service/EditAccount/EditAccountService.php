<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Application\Service\EditAccount;

use Manuel\LocalBank\Account\AccountRepository;
use Manuel\LocalBank\Account\Client\ClientRepository;
use Manuel\LocalBank\Account\Client\Event\ClientEditedEvent;
use Manuel\LocalBank\Account\Event\AccountEditedEvent;
use Manuel\LocalBank\Account\Exception\AccountNotFoundException;
use Manuel\LocalBank\Event\EventHandler;
use Manuel\LocalBank\ValueObject\Address;
use Manuel\LocalBank\ValueObject\Email;
use Manuel\LocalBank\ValueObject\EntityId;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class EditAccountService
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

    public function edit(EntityId $accountId, EditAccountRequest $request)
    {
        $account = $this->accountRepository->findById($accountId);

        if (!$account) {
            throw new AccountNotFoundException($accountId->getId());
        }

        $client = $account->getClient();
        $client->setEmail(new Email($request->email));
        $client->setAddress(new Address($request->address));

        $this->clientRepository->save($client);
        $this->accountRepository->save($account);

        $this->eventHandler->dispatch(new ClientEditedEvent($client));
        $this->eventHandler->dispatch(new AccountEditedEvent($account));

        return $account->getAccountId();
    }
}