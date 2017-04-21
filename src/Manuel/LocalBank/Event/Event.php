<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Event;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
abstract class Event
{
    /**
     * @var bool
     */
    private $committed = false;

    public function commit()
    {
        $this->committed = true;
    }

    /**
     * @return boolean
     */
    public function isCommitted(): bool
    {
        return $this->committed;
    }
}