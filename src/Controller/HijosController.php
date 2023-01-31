<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HijosController extends AbstractController
{
    /**
     * @Route("/hijos", name="app_hijos")
     */
    public function index(): Response
    {
        return $this->render('hijos/index.html.twig', [
            'controller_name' => 'HijosController',
        ]);
    }
}
