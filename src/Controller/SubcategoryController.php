<?php

namespace App\Controller;

use App\Form\SubcategoryType;
use App\Entity\Subcategory;
use App\Entity\Category; 
use App\Entity\Product;  
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

final class SubcategoryController extends AbstractController
{    
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    #[Route('/subcategorycontroller', name: 'app_subcategory')]
    public function index(): Response
    {
        $subcategories = $this->em->getRepository(Subcategory::class)->findAll();
        return $this->render('subcategorycontroller/index.html.twig',[
            'subcategories' => $subcategories
        ]);
        
    }
    #[Route('/create-subcategory', name:'create_subcategory')]
    public function createsubcategory(Request $request): Response
    {
        $subcategory = new Subcategory();
        $form = $this->createForm(SubcategoryType::class, $subcategory);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $category = $this->em->getRepository(Category::class)->findOneBy(['name' => $category_id]);
            $product = $this->em->getRepository(Product::class)->findOneBy(['name'=> $product_id]);
            if (!$category || !$product){
                throw $this->createNotFoundException('Category or Product not found');
            }
            $subcategory->setCategory($category);
            $subcategory->setProduct($product);
        
            $this->em->persist($subcategory);
            $this->em->flush();
       
            $this->addFlash('message','Inserted Successfully.');
            return $this->redirectToRoute('app_subcategory');

        }
        return $this->render('subcategorycontroller/create.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    #[Route('/read-subcategory/{id}', name:'read_subcategory')]
    public function readsubcategory(int $id): Response
    {
        $subcategory = $this->em->getRepository(Subcategory::class)->find($id);
        if (!$subcategory){
            throw $this->createNotFoundException('Subcategory not found!');
        }
        return $this->render('subcategorycontroller/read.html.twig',[
            'subcategory'=> $subcategory
        ]);
    }
    
    #[Route('/edit-subcategory/{id}', name:'edit_subcategory')]
    public function editsubcategory(Request $request ,int $id): Response
    {
        $subcategory = $this->em->getRepository(Subcategory::class)->find($id);
        if (!$subcategory){
            throw $this->createNotFoundException('Subcategory not found!');
           
        }
        $form = $this->createForm(SubcategoryType::class,$subcategory);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($subcategory);
            $this->em->flush();

            $this->addFlash('message','Updated Successfully.');
            return $this->redirectToRoute('app_subcategory');
        }
        return $this->render('subcategorycontroller/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }
    #[Route('/delete-subcategory/{id}', name:'delete_subcategory')]
    public function deletesubcategory(int $id): Response
    {
        $subcategory = $this->em->getRepository(Subcategory::class)->find($id);
        if (!$subcategory){
            throw $this->createNotFoundException('Subcategory not found!');
        return $this->redirectToRoute('app_subcategory');
           
    }
    $this->em->remove($subcategory);
    $this->em->flush();

    $this->addFlash('message','Deleted Successfully.');
    return $this->redirectToRoute('app_subcategory');

}
}
