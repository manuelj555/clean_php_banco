<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Event;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
abstract class EventHandler
{
    abstract public function dispatch(Event $event);

    public function commitEvents(EventStore $object)
    {
        foreach ($object->getUncommitedEvents() as $event) {
            $this->dispatch($event);
        }
    }
}