<?php
/**
 * @author <akartis-dev>
 */

namespace App\Controller;

use App\Services\CartServices;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AppController
{
    #[Route('/user/profil', name: "user_profil")]
    public function profil()
    {
        return $this->render('user/profil.html.twig');
    }

    #[Route('/user/cart', name: "user_cart")]
    public function cart(CartServices $cartServices)
    {
        return $this->render('user/cart.html.twig', [
            'cart' => $cartServices->getLastActiveCart()
        ]);
    }
}
