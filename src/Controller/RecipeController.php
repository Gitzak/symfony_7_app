<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    #[Route(
        path: '/recipe',
        name: 'recipe.index',
    )]    public function index(Request $request): Response
    {
        // return new Response(content: 'Recettes');
        return $this->render('recipe/index.html.twig');
    }

    #[Route(
        path: '/recipe/{slug}-{id}',
        name: 'recipe.show',
        requirements: ['id' => '\d+', 'slug' => '[a-zA-Z0-9\-]+']
    )]    public function show(Request $request, string $slug, int $id)
    {
        // dd($request->attributes->get(key: 'id'), $request->attributes->get(key: 'slug'));
        // dd($slug, $id);

        // return new JsonResponse([
        //     'id' => $id,
        //     'slug' => $slug
        // ]);

        // return new Response(content: 'Recette :' . $request->attributes->get(key: 'slug'));

        
        return $this->render('recipe/show.html.twig', [
            'slug' => $slug,
        ]);
    }
}