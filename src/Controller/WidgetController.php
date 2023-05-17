<?php
/**
 * @author <akartis-dev>
 */

namespace App\Controller;

use App\Services\CartServices;

class WidgetController extends AppController
{
    public function cartHeader(CartServices $cartServices)
    {
        $cart = $cartServices->getLastActiveCart();
        $products = $cart->getProducts()->toArray();
        $total = array_reduce($products, function ($prev, $acc) {
            return $prev + $acc->getPrice();
        }, 0);

        return $this->render('elements/_cart_header.html.twig', [
            'total' => $total,
            'items' => count($products)
        ]);
    }
}
