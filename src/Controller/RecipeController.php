<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    )]    public function index(Request $request, RecipeRepository $recipeRepository, EntityManagerInterface $em): Response
    {

        dd($recipeRepository->findTotalDuration());
        
        $data = $recipeRepository->findWithDurationLowerThen(10);
        // $data[0]->setTitle('tajine 3anzi b bar9oo9');
        // $em->flush();
        // return new Response(content: 'Recettes');
        return $this->render('recipe/index.html.twig', [
            'data' => $data
        ]);
    }

    #[Route(
        path: '/recipe/{slug}-{id}',
        name: 'recipe.show',
        requirements: ['id' => '\d+', 'slug' => '[a-zA-Z0-9\-]+']
    )]    public function show(Request $request, string $slug, int $id, RecipeRepository $recipeRepository)
    {
        // dd($request->attributes->get(key: 'id'), $request->attributes->get(key: 'slug'));
        // dd($slug, $id);

        // return new JsonResponse([
        //     'id' => $id,
        //     'slug' => $slug
        // ]);

        // return new Response(content: 'Recette :' . $request->attributes->get(key: 'slug'));

        $recipe = $recipeRepository->find($id);

        if($recipe->getSlug() !== $slug) {
            return $this->redirectToRoute('recipe.show', [
                'slug' => $recipe->getSlug(),
                'id' => $recipe->getId()
            ]);
        }

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}
