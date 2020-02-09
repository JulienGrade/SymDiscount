<?php


namespace App\Service;


use Doctrine\Common\Persistence\ObjectManager;

class StatsService
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Permet de récupérer le produit le mieux noté
     *
     * @return mixed
     */
    public function getRating(){
        return $this->manager->createQuery(
            'SELECT AVG(c.rating) as note, p.name, p.price, p.id, p.image, p.slug, u.firstName, u.lastName
            FROM App\Entity\Comment c
            JOIN c.product p
            JOIN c.author u
            GROUP BY p
            ORDER BY note DESC'
        )->setMaxResults(1)->getResult();

    }

    /**
     * Permet de récupérer le produit le mieux noté
     *
     * @return mixed
     */
    public function getRatings(){
        return $this->manager->createQuery(
            'SELECT AVG(c.rating) as note,p.content, p.name, p.price, p.id, p.image, p.slug, u.firstName, u.lastName
            FROM App\Entity\Comment c
            JOIN c.product p
            JOIN c.author u
            GROUP BY p
            ORDER BY note DESC'
        )->setMaxResults(4)->getResult();

    }

    public function getLastProducts(){
        return $this->manager->createQuery(
            'SELECT p.createdAt as date, p.name,p.price, p.id, p.image, p.slug,p.content, p.discount
            FROM App\Entity\Product p
            GROUP BY p
            ORDER BY date DESC'
        )->setMaxResults(3)->getResult();
    }
}