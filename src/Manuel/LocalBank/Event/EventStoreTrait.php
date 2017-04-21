<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace Manuel\LocalBank\Event;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
trait EventStoreTrait
{
    /**
     * @var Event[]
     */
    private $events = [];

    public function getUncommitedEvents()
    {
        return array_map(function (Event $event) {
            return !$event->isCommitted();
        }, $this->events);
    }

    protected function pushEvent(Event $event)
    {
        $this->events[] = $event;
    }
}