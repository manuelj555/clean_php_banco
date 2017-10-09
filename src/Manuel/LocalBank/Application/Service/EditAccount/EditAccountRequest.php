<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Application\Service\EditAccount;

use Manuel\LocalBank\Account\Account;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class EditAccountRequest
{
    /**
     * @Assert\Email()
     */
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
            $account->getClient()->getAddress(),
            $account->isLocked()
        );
    }
}