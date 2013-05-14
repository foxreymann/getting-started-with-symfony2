<?php

namespace Sensio\Bundle\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ConverterController extends Controller
{
    /**
     * @Route("/convert/{celsius}/fahrenheit.{_format}",
     *  requirements={ "celsius"="^\d+$" }
     * )
     * @Template()
     */
    public function celsiusAction($celsius)
    {
        $fahrenheit = ($celsius * 9) / 5 + 32;

        return array(
            'fahrenheit' => $fahrenheit,
            'celsius' => $celsius
        ); 
    }



}
