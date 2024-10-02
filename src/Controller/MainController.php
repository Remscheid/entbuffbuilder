<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    #[Route('/legends', name: 'app_legends')]
    public function legends(
        LoggerInterface $logger,
    ): Response {
        $logger->info('Calling route: legends');

        return $this->render('main/legends.html.twig', [
        ]);
    }

    #[Route('/r3', name: 'app_r3')]
    #[Route('/restoration', name: 'app_restoration')]
    public function restoration(
        LoggerInterface $logger,
    ): Response {
        $logger->info('Calling route: restoration');

        return $this->render('main/restoration.html.twig', [
        ]);
    }

    #[Route('/resurgence', name: 'app_resurgence')]
    public function resurgence(
        LoggerInterface $logger,
    ): Response {
        $logger->info('Calling route: resurgence');

        return $this->render('main/resurgence.html.twig', [
        ]);
    }
}
