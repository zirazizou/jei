<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/24/2018
 * Time: 3:52 PM
 */

namespace WriterBundle\Classes\FactoryType;


class FournisseurType extends AbstractType
{
    public function __construct($parameters, $writer)
    {
        parent::__construct($parameters, $writer);
        $this->type = "founisseur";
    }


}