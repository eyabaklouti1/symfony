<?php

namespace App\Controller;

use App\Form\ProductType;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class ProductcontrollerController extends AbstractController
{
    #[Route('/productcontroller', name: 'app_productcontroller')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductcontrollerController.php',
        ]);
    }
    #[Route('/create-product', name: 'create-product')] 
    public function createproduct()
    {
        $product = new product();   //the object of the entity
        $form = $this->createForm(productType::class, $product); //générer le formulaire
        $form->handleRequest($request); //remplir le formulaire avec les données soumises

        return $this->render('productcontroller/product.html.twig', [
            'form' => $form->createView(), // product.html.twig contient le code HTML du formulaire.


        ]);
    }
    
}
