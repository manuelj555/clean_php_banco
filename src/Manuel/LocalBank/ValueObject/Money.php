<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\ValueObject;

use Manuel\LocalBank\ValueObject\Exception\InsufficientAmountException;
use Manuel\LocalBank\ValueObject\Exception\NotEqualCurrencyException;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class Money
{
    /**
     * @var float
     */
    private $amount;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * Money constructor.
     *
     * @param float $amount
     * @param Currency $currency
     */
    public function __construct(float $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * @param Money $money
     * @return bool
     */
    public function equals(Money $money): bool
    {
        return $money->getCurrency()->equals($this->getCurrency())
        and $money->getAmount() === $this->getAmount();
    }

    /**
     * @param Money $money
     * @return Money
     */
    public function add(Money $money): Money
    {
        $this->checkCurrency($money);

        return new self(
            $this->getAmount() + $money->getAmount(),
            $this->getCurrency()
        );
    }

    /**
     * @param Money $money
     * @return Money
     */
    public function deduct(Money $money): Money
    {
        $this->checkCurrency($money);

        if ($this->getAmount() < $money->getAmount()) {
            throw new InsufficientAmountException();
        }

        return new self(
            $this->getAmount() - $money->getAmount(),
            $this->getCurrency()
        );
    }

    /**
     * @param Money $money
     */
    private function checkCurrency(Money $money)
    {
        if (!$money->getCurrency()->equals($this->getCurrency())) {
            throw new NotEqualCurrencyException();
        }
    }
}