<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// class HomeController extends AbstractController
// {
//     #[Route('/home', name: 'app_home')]
//     public function index(): Response
//     {
//         return $this->render('home/index.html.twig', [
//             'controller_name' => 'HomeController',
//         ]);
//     }
// }

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    function index(Request $request): Response
    {

        dd($request->query->all());

        return new Response(content: "Hello dev " . $request->query->get(key: 'name', default: 'Inconnu'));
    }
}
