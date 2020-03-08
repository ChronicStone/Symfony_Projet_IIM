<?php
// src/Controller/LuckyController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Assets\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class LuckyController 
{
    public function number() 
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky Number: '.$number.'<body></html>'
        );
    }
}