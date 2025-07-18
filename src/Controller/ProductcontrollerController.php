<?php

namespace App\Controller;

use App\Form\ProductType;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;


final class ProductcontrollerController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em){
         $this->em = $em;

    }  

    #[Route('/productcontroller', name: 'app_productcontroller')]
    public function index(): JsonResponse{

         $products = $this->em->getRepository(Product::class)->findAll();
    
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductcontrollerController.php',
        ]);
    }

    #[Route('/create-product', name: 'create-product')] 
    public function createproduct(Request $request)
    {
        $product = new Product();   //the object of the entity
        $form = $this->createForm(ProductType::class, $product); //générer le formulaire
        $form->handleRequest($request); //remplir le formulaire avec les données soumises
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($product);
            $this->em->flush();


            $this->addFlash('message','Inserted Successfully.');

        }
        return $this->render('productcontroller/product.html.twig', [
            'form' => $form->createView(), // product.html.twig contient le code HTML du formulaire.


        ]);
    }
    
}
