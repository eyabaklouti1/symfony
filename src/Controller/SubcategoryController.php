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
        }

        // Check if there are categories associated with this subcategory
        if ($subcategory->getCategories()->count() > 0) {
            // Set subcategory to null for all associated categories
            foreach ($subcategory->getCategories() as $category) {
                $category->setSubcategory(null);
            }
        }

        // Check if there are products associated with this subcategory
        if ($subcategory->getProducts()->count() > 0) {
            // Set subcategory to null for all associated products
            foreach ($subcategory->getProducts() as $product) {
                $product->setSubcategory(null);
            }
        }

        try {
            $this->em->remove($subcategory);
            $this->em->flush();
            $this->addFlash('message','Deleted Successfully.');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Error deleting subcategory: ' . $e->getMessage());
        }

        return $this->redirectToRoute('app_subcategory');
    }
}
