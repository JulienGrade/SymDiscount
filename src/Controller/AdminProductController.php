<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    /**
     * @Route("/admin/products", name="admin_products_index")
     * @param ProductRepository $repo
     * @return Response
     */
    public function index(ProductRepository $repo)
    {
        return $this->render('admin/product/index.html.twig', [
            'products' => $repo->findAll()
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'edition de produit
     *
     * @Route("/admin/products/{id}/edit", name="admin_products_edit")
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product) {
        $form = $this->createForm(ProductType::class, $product);

        return $this->render('admin/product/edit.html.twig', [
           'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
