<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @param ObjectManager $manager
     * @return Response
     */
    public function home(ObjectManager $manager)
    {
        //$users = $manager->createQuery('SELECT u FROM App\Entity\User u')->getResult();
        //$threeProducts = $manager->createQuery('')->getResult();

        //$heartProduct = $manager->createQuery('')->getResult();

        //$lastProducts = $manager->createQuery('')->getResult();

        $ratingProducts = $manager->createQuery(
            'SELECT AVG(c.rating) as note, p.name, p.price, p.id, p.image, p.slug, u.firstName, u.lastName
            FROM App\Entity\Comment c
            JOIN c.product p
            JOIN c.author u
            GROUP BY p
            ORDER BY note DESC'
        )->setMaxResults(1)->getResult();


        return $this->render('home.html.twig', [
            'stats'          => compact('ratingProducts'),
            'ratingProducts' => $ratingProducts,

        ]);

    }
}
