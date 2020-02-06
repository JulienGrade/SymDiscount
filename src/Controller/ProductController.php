<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="products_index")
     */
    public function index()
    {
        return $this->render('product/index.html.twig');
    }

    /**
     * Permet de créer un produit
     *
     * @Route("/products/new", name="products_create")
     * @param Request $request
     * @param ObjectManager $manager
     * @return RedirectResponse|Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $product = new Product();

        $form= $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($product);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le produit <strong>{$product->getName()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('products_index');
        }
        return$this->render('product/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
