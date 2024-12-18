<?php
// src/Controller/FicheFraisController.php

namespace App\Controller;

use App\Repository\FicheFraisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FicheFraisController extends AbstractController
{
    #[Route('/top-visitors', name: 'top_visitors')]
    public function topVisitors(Request $request, FicheFraisRepository $ficheFraisRepository): Response
    {
        // Récupérer le mois sélectionné à partir de la requête GET (par défaut : janvier 2024)
        $mois = $request->query->get('mois', '2024-01');

        // Convertir le mois sous forme de chaîne en objet DateTime
        $moisDateTime = \DateTime::createFromFormat('Y-m', $mois);

        if (!$moisDateTime) {
            throw $this->createNotFoundException('Invalid month format.');
        }

        // Récupérer les top 10 visiteurs pour le mois donné
        $topVisitors = $ficheFraisRepository->findTop10VisitorsByMonth($moisDateTime);

        return $this->render('fiche_frais/top_visitors.html.twig', [
            'topVisitors' => $topVisitors,
            'selectedMonth' => $mois,
        ]);
    }
}