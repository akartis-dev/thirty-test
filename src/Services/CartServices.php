<?php
/**
 * @author <akartis-dev>
 */

namespace App\Services;

use App\Entity\Cart;
use App\Entity\Products;
use App\Entity\User;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class CartServices
{
    private ?User $user;

    public function __construct(
        private CartRepository         $cartRepository,
        private Security               $security,
        private EntityManagerInterface $em
    )
    {
        $this->user = $this->security->getUser();
    }

    /**
     * Add product to bdd cart
     *
     * @param Products $products
     * @return void
     */
    public function addToCart(Products $products)
    {
        $lastCart = $this->cartRepository->getLastActiveCartByUser($this->user);

        if (!$lastCart) {
            $lastCart = new Cart();
            $lastCart->setUser($this->user);
            $this->em->persist($lastCart);
        }

        $lastCart->addProduct($products);
        $this->em->flush();
    }

    public function getLastActiveCart()
    {
        return $this->cartRepository->getLastActiveCartByUser($this->user);
    }
}
