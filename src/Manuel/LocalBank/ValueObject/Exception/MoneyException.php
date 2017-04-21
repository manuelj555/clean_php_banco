<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\ValueObject\Exception;

use Manuel\LocalBank\Exception\LocalBankException;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class MoneyException extends \LogicException implements LocalBankException
{

}