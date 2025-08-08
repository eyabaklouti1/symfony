<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]

final class AdminController extends AbstractController
{
    #[Route('/dashborad' , name: 'admin_dashboard')]
    public function admindashboard(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN' ,null,'User tried to access /admin/dashboard without ROLE_ADMIN');
        return $this->render('admin/dashboard.html.twig', [
            'title' => 'Admin Dashboard',
        ]);
    }
    


}