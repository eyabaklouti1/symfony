<?php

namespace App\Controller;

use App\Form\ProductType;
use App\Entity\Product;
use App\Entity\Category; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


final class ProductcontrollerController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em){
         $this->em = $em;

    }  

    #[Route('/productcontroller', name: 'app_productcontroller')]
    public function index(): Response{

         $products = $this->em->getRepository(Product::class)->findAll();
    
        return $this->render('productcontroller/index.html.twig',[
                'products' => $products
        ]);
    }


    #[Route('/create-product', name: 'create_product')]
public function createproduct(Request $request): Response
{
    $product = new Product();
    $form = $this->createForm(ProductType::class, $product);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

        $this->em->persist($product);
        $this->em->flush();

        $this->addFlash('message', 'Product inserted successfully.');
        return $this->redirectToRoute('app_productcontroller');
    }

    return $this->render('productcontroller/create.html.twig', [
        'form' => $form->createView(),
    ]);
}

    #[Route('/read-product/{id}', name:'read_product')]
    public function readproduct(int $id): Response
    {
        $product = $this->em->getRepository(Product::class)->find($id);
        if (!$product){
            throw $this->createNotFoundException('Product not found.');
        }
        return $this->render('productcontroller/read.html.twig',[
            'product' => $product,
        ]);
    }
    
    #[Route('/edit-product/{id}', name:'edit_product')]
    public function editproduct(Request $request , int $id): Response
    {
        $product = $this->em->getRepository(Product::class)->find($id);
        if (!$product) {
             throw $this->createNotFoundException('Product not found.');
        }
        $form = $this->createForm(ProductType::class , $product);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isvalid()){
            $this->em->persist($product);
            $this->em->flush();


            $this->addFlash('message','Updated Successfully.');
            return $this->redirectToRoute('app_productcontroller');
        }
         return $this->render('productcontroller/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    
    }
    #[Route('/delete-product/{id}' , name:'delete_product')]
    public function deleteproduct($id): Response
    {
        $product = $this->em->getRepository(Product::class)->find($id);
        if (!$product){
           $this->addFlash('error', 'Product not found.');
        return $this->redirectToRoute('app_productcontroller');
        }
       try {
            $this->em->remove($product);
            $this->em->flush();
            $this->addFlash('message','Deleted Successfully.');
        } catch (\Exception $e) {
              $this->addFlash('error', 'Error deleting product: '.$e->getMessage());
    }


        $this->addFlash('message','Deleted Syccessfully.');
        return $this->redirectToRoute('app_productcontroller');


    }
}