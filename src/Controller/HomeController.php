<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\StatsService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @param StatsService $statsService
     * @return Response
     */
    public function home(StatsService $statsService)
    {
        //$users = $manager->createQuery('SELECT u FROM App\Entity\User u')->getResult();
        //$threeProducts = $manager->createQuery('')->getResult();

        //$heartProduct = $manager->createQuery('')->getResult();

        //$lastProducts = $manager->createQuery('')->getResult();

        $ratingProducts = $statsService->getRatings();

        $ratingProduct = $statsService->getRating();

        $lastProducts = $statsService->getLastProducts();

        return $this->render('home.html.twig', [
            'stats'          => compact('ratingProducts', 'lastProducts', 'ratingProduct'),
            'ratingProducts' => $ratingProducts,
            'ratingProduct' => $ratingProduct,
            'lastProducts'   => $lastProducts

        ]);

    }
}
