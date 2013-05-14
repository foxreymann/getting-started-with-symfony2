<?php

namespace Sensio\Bundle\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\TrainingBundle\Converter\CelsiusConverter;

class ConverterController extends Controller
{
    /**
     * @Route("/convert/{celsius}/fahrenheit.{_format}",
     *  requirements={ "celsius"="^\d+$", "_format"="^xml|json$" }
     * )
     * @Template()
     */
    public function celsiusAction($celsius)
    {
        $converter = new CelsiusConverter();

        $fahrenheit = $converter->toFahrenheit($celsius);

        return array(
            'fahrenheit' => $fahrenheit,
            'celsius' => $celsius
        ); 
    }



}
