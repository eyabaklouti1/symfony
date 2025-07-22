<?php

namespace App\Controller;

use App\Form\CategoryType;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


final class CategorycontrollerController extends AbstractController
{
   private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em){
         $this->em = $em;
    }


    #[Route('/categorycontrollerr', name: 'app_categorycontroller')]
    public function index(): Response
    {
          $categories  = $this->em->getRepository(Category::class)->findAll();
        return $this->render('categorycontroller/index.html.twig', [
             'categories' => $categories
        ]);
    }


    #[Route('/create-category' , name:'create_category')]
    public function createcategory(Request $request): Response
    {
        $category = new Category();
        $form = $this->createform(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($category);
            $this->em->flush();
        
       $this->addFlash('message','');
            return $this->redirectToRoute('app_categorycontroller');
        }
        return $this->render('categorycontroller/create.html.twig',[
         'form'=>$form->createView()
        ]);
    
   

    }

    #[Route('/read-category/{id}', name:'read_category')]
    public function readcategory(int $id): Response
    {
        $category = $this->em->getRepository(Category::class)->find($id);
        if (!$category)
        {   
            throw $this->createNotFoundException('Category not found.');    
        }
        return $this->render('categorycontroller/read.html.twig',[
            'category' => $category
        ]);
    }




    #[Route('/edit-category/{id}', name:'edit_category')]
    public function editcategory(Request $request , int $id): Response
    {
        $category = $this->em->getRepository(Category::class)->find($id);
        if (!$category){
            throw $this->createNotFoundException('category not found.');
        }
        $form = $this->createform(CategoryType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($category);
            $this->em->flush();


            $this->addFlash('message','');
            return $this->redirectToRoute('app_categorycontroller');

        }
        return $this->render('categorycontroller/edit.html.twig', [
            'form' => $form->createView(),
        ]);

    }


    

    #[Route('/delete-category/{id}', name:'delete_category')]
    public function deletecategory(int $id) : Response
    {
        $category = $this->em->getRepository(Category::class)->find($id);
        if (!$category){
            $this->addFlash('error,Category not found.');
        return $this->redirectTORoute('app_categorycontroller');
        }
    $this->em->remove($category);
    $this->em->flush();

    $this->addFlash('message','');
    return $this->redirectToRoute('app_categorycontroller');
    }
     
}