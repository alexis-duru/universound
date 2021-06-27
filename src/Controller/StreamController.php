<?php

namespace App\Controller;

use App\Entity\Track;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Form\TrackUploadFormType;
use App\Repository\TrackRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StreamController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
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

    /**
     * @Route("/edit/{id}", name="app_stream_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Track $track): Response
    {
        $user = $this->security->getUser();

        if ($user === $track->getArtist()) {
            $form = $this->createForm(TrackUploadFormType::class, $track);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('app_stream');
            }

            return $this->render('stream/edit.html.twig', [
                'track' => $track,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('common/error.html.twig', [
            'error' => 401,
            'message' => 'Unauthorized access',
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_stream_delete", methods={"POST"})
     */
    public function delete(Request $request, Track $track): Response
    {
        $user = $this->security->getUser();
        if ($user === $track->getArtist()) {
            if ($this->isCsrfTokenValid('delete'.$track->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($track);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_stream');
        }

        return $this->render('common/error.html.twig', [
            'error' => 401,
            'message' => 'Unauthorized acces',
        ]);
    }



    /**
     * @Route("/stream/comment/{id}", name="app_stream_comment", methods={"GET", "POST"})
     */

    public function findAll(Track $track, Request $request): Response
    {
        $comments = $track->getComments();

        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->security->getUser();
            $comment->setAuthor($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $track->addComment($comment);

            $entityManager->flush();

            return $this->redirectToRoute('app_stream_comment', ['id' => $track->getId()]);
        }

        return $this->render('stream/comment.html.twig', [
            'track' => $track,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/like/{id}", name="track_like")
     */
    public function like(Track $track): Response
    {
        //* Si je n'ai pas encore liké le post, alors je rajoute un like
        //* Sinon j'enlève le like.
        //* Sachant que liker n'est pas une entité, il suffira de modifier l'array like du post pour rajouter l'user.
        if ($track->getLikes()->contains($this->getUser())) {
            $track->removeLike($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToroute('app_stream', ['id' => $track->getId()]);
        }

        $track->addLike($this->getUser());
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToroute('app_stream', ['id' => $track->getId()]);
    }
    
}
