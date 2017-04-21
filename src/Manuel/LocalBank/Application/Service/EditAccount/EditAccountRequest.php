<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Application\Service\EditAccount;

use Manuel\LocalBank\Account\Account;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class EditAccountRequest
{
    public $email;
    public $address;
    public $locked;

    /**
     * EditAccountRequest constructor.
     *
     * @param $email
     * @param $address
     * @param $locked
     */
    public function __construct($email, $address, $locked)
    {
        $this->email = $email;
        $this->address = $address;
        $this->locked = $locked;
    }

    public static function createFromAccount(Account $account)
    {
        return new static(
            $account->getClient()->getEmail()->getEmail(),
            null, //$account->getClient()->getAddress(),
            $account->isLocked()
        );
    }
}