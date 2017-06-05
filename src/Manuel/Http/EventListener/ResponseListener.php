<?php
/**
 * User: manuel
 * Date: 05-06-2017
 */

namespace Manuel\Http\EventListener;

use Manuel\Http\Response\Redirect;
use Manuel\Http\Response\View;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class ResponseListener implements EventSubscriberInterface
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * ResponseListener constructor.
     *
     * @param \Twig_Environment $twig
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(\Twig_Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $data = $event->getControllerResult();

        if ($data instanceof View) {
            $content = $this->twig->render($data->getName(), $data->getParameters());
            $response = new Response($content);
            $event->setResponse($response);
        }

        if ($data instanceof Redirect) {
            $url = $this->urlGenerator->generate(
                $data->getRoute(),
                $data->getRouteParameters()
            );
            $response = new RedirectResponse($url, $data->getStatus());
            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => 'onKernelView',
        ];
    }
}