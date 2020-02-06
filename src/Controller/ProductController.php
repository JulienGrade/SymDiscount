<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Service\PaginationService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products/{page<\d+>?1}", name="products_index")
     * @param ProductRepository $repo
     * @param $page
     * @param PaginationService $pagination
     * @return Response
     */
    public function index(ProductRepository $repo, $page, PaginationService $pagination)
    {
        $pagination ->setEntityClass(Product::class)
                    ->setPage($page);

        return $this->render('product/index.html.twig', [
            'pagination' => $pagination
        ]);
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

    /**
     * Permet d'afficher un seul produit
     *
     * @Route("/products/{slug}", name="products_show")
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }

}
