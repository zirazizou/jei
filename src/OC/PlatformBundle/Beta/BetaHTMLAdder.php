<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 2/9/2018
 * Time: 12:00 PM
 */

namespace OC\PlatformBundle\Beta;


use Symfony\Component\HttpFoundation\Response;

class BetaHTMLAdder
{
    public function addBeta(Response $response, $remainingDays){

        $content = $response->getContent();
        $html = '<div style="background: orange; width: 100%;text-align: center; padding: 0.5em;">Beta J-'.(int) $remainingDays.'!</div>';

        $content = str_replace(
            '<body>',
            '<body>'.$html,
            $content
        );

        $response->setContent($content);
        return $response;
    }

}