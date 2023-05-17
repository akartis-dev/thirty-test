<?php
/**
 * @author <akartis-dev>
 */

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use App\Services\CartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route("/", name: "app_index")]
    public function index(ProductsRepository $productsRepository): Response
    {
        $items = $productsRepository->findForIndex(limit: 6);

        return $this->render('index.html.twig', [
            'products' => $items
        ]);
    }

    #[Route("/product/{id}", name: "app_product")]
    public function product(Products $product, ProductsRepository $productsRepository, Request $request, CartServices $cartServices): Response
    {
        $items = $productsRepository->findForIndex(limit: 6);

        if ($request->getMethod() === Request::METHOD_POST) {
            $cartServices->addToCart($product);

            $this->addFlash('success', 'Produit ajouter au panier avec succès');
            return $this->redirectToRoute('user_cart');
        }

        return $this->render('product.html.twig', [
            'product' => $product
        ]);
    }
}
