<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class ActionController extends AbstractController
{
    #[Route('/admin' , name: 'admin')]
    public function admindashboard(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN' ,null,'User tried to access /admin without ROLE_ADMIN');
          return $this->render('Action/action.html.twig', [
            'title' => 'Admin Dashboard',
        ]);
    }
    #[IsGranted('ROLE_SUPER_ADMIN')]
    #[Route('/super_admin' , name: 'super_admin')]
    public function super_admindashboard(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN' ,null,'User tried to access /super_admin without ROLE_SUPER_ADMIN');
          return $this->render('Action/action.html.twig', [
            'title' => 'Admin Dashboard',
        ]);
    }

}