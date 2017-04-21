<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Application\Service\CreateAccount;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class Request
{
    public $email;
    public $address;
    public $initialAmount;

    /**
     * Request constructor.
     *
     * @param $email
     * @param $address
     * @param $initialAmount
     */
    public function __construct($email, $address, $initialAmount)
    {
        $this->email = $email;
        $this->address = $address;
        $this->initialAmount = $initialAmount;
    }
}