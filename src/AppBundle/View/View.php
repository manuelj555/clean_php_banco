<?php
/**
 * User: manuel
 * Date: 21-04-2017
 */

namespace AppBundle\View;

/**
 * @author maguirre <maguirre@developerplace.com>
 */
class View
{
    public static function render($view, $params = [])
    {
        return new static($view, $params);
    }

    public static function redirectToRoute($route, $params = [])
    {

    }
}