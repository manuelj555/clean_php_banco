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
    public function dispatch(Event $event)
    {
        $this->doDispatch($event);

        $event->commit();
    }

    public function commitEvents(EventStore $object)
    {
        foreach ($object->getUncommitedEvents() as $event) {
            $this->dispatch($event);
        }
    }

    abstract protected function doDispatch(Event $event);
}