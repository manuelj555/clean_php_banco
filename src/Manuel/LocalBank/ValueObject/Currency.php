<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\ValueObject;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class Currency
{
    const BS = 'Bs';

    /**
     * @var string
     */
    private $type;

    /**
     * Currency constructor.
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function equals(Currency $currency)
    {
        return $this->getType() == $currency->getType();
    }
}