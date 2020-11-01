<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ItemsController extends AbstractController
{
    /**
     * @Route("/items", name="items")
     */
    public function index()
    {
        return $this->render('items/index.html.twig', [
            'controller_name' => 'ItemsController',
        ]);
    }
}
