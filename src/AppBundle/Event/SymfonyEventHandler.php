<?php
/**
 * User: manuel
 * Date: 20-04-2017
 */

namespace AppBundle\Event;

use Manuel\LocalBank\Event\Event;
use Manuel\LocalBank\Event\EventHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class SymfonyEventHandler extends EventHandler
{
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * SymfonyEventHandler constructor.
     *
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    protected function doDispatch(Event $event)
    {
        $eventName = get_class($event);

        if (!$this->dispatcher->hasListeners($eventName)) {
            return;
        }

        foreach ($this->dispatcher->getListeners($eventName) as $listener) {
            call_user_func($listener, $event);
        }
    }
}