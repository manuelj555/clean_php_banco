<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Account\Exception;

use Manuel\LocalBank\Exception\LocalBankException;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class AccountNotFoundException extends \InvalidArgumentException implements LocalBankException
{

}