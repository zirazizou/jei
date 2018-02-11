<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 2/9/2018
 * Time: 12:14 PM
 */

namespace OC\PlatformBundle\Beta;


use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class BetaListener
{
    protected $betaHTML;

    protected $endDate;

    public function __construct(BetaHTMLAdder $betaHTML, $endDate)
    {
        $this->betaHTML = $betaHTML;
        $this->endDate = new \DateTime($endDate);
    }

    public function processBeta(FilterResponseEvent $event){

        $remainingDays = $this->endDate->diff(new \DateTime())->days;

        if($remainingDays <= 0 ){
            return;
        }

        if(!$event->isMasterRequest()){
            return ;
        }


        $response = $this->betaHTML->addBeta($event->getResponse(), $remainingDays);

        $event->setResponse($response);



    }

}