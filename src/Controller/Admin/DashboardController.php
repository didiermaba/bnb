<?php

namespace App\Controller\Admin;

use App\Entity\Room;
use App\Entity\User;
use App\Entity\Review;
use App\Entity\Booking;
use App\Entity\Equipment;
use App\Entity\Favorite;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('user/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
             ->setTitle('<img src="/images/icon.svg" width="50" ')
             ->setFaviconPath('/images/icon.svg')
             
             ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Rooms', 'fas fa-list', Room::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Booking', 'fas fa-list', Booking::class);
        yield MenuItem::linkToCrud('favorites', 'fas fa-list', Favorite::class);
        yield MenuItem::linkToCrud('Reviews', 'fas fa-list', Review::class);
        yield MenuItem::linkToCrud('Equipements', 'fas fa-list', Equipment::class);
    }
}
