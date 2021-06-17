<?php

namespace App\Controller;

use App\Repository\TrackRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StreamController extends AbstractController
{
    /**
     * @Route("/stream", name="app_stream", methods={"GET"})
     */
    public function index(TrackRepository $trackRepository): Response
    {
        return $this->render('stream/index.html.twig', [
            'tracks' => $trackRepository->findAll(),
        ]);
    }
}
