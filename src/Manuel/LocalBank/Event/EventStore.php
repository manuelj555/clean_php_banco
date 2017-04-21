<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Event;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
interface EventStore
{
    /**
     * @return Event[]
     */
    public function getUncommitedEvents();
}