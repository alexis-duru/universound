<?php

namespace App\Controller;

use App\Entity\Track;
use App\Repository\TrackRepository;
use Symfony\Component\HttpFoundation\Request;
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

     /**
     * @Route("/stream/{id}", name="app_stream_details", methods={"GET", "POST"})
     */
    public function show(Track $track, Request $request): Response
    {
        return $this->render('stream/details.html.twig', [
            'track' => $track,
        ]);
    }
}
