<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class CoreController extends AbstractController
{
    /**
     * @Route(name="homepage", path="/")
     *
     * @return Response
     */
    public function homepageAction()
    {
        return $this->render('base.html.twig');
    }
}

