<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Track;
use App\Entity\Comment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/universounddashboard", name="universounddashboard")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Universound Admin');
    }

    public function configureMenuItems(): iterable
    {   
        yield MenuItem::linktoDashboard(' Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Tracks', 'fas fa-music', Track::class);
        // yield MenuItem::linkToCrud('Comments', 'fas fa-comment', Comment::class);
    }
}
