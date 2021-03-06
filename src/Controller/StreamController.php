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
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StreamController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    // GLOBAL STREAM //

    /**
     * @Route("/stream", name="app_stream", methods={"GET"})
     */
    public function index(TrackRepository $trackRepository): Response
    {
        return $this->render('stream/index.html.twig', [
            'tracks' => $trackRepository->findByAll(),
        ]);
    }

    // DETAILS TRACK //

    /**
     * @Route("/stream/{id}", name="app_stream_details", methods={"GET", "POST"})
     */
    public function show(Track $track, Request $request): Response
    {
        return $this->render('stream/details.html.twig', [
            'track' => $track,
        ]);
    }

    // EDIT TRACK //

    /**
     * @IsGranted("ROLE_USER", statusCode=401, message="You have to be logged-in to access this ressource")
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

                return $this->redirectToRoute('app_stream_details', ['id' => $track->getId()]);
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

    // DELETE TRACK //

    /**
     * @IsGranted("ROLE_USER", statusCode=401, message="You have to be logged-in to access this ressource")
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

    // COMMENT //

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
     * @IsGranted("ROLE_USER", statusCode=401, message="You have to be logged-in to access this ressource")
     * @Route("comment/{id}/editcomment", name="app_stream_editcomment", methods={"GET", "POST"})
     */
    public function editComment(Request $request, Comment $comment): Response
    {
        $track = $comment->getTrack();
        $user = $this->security->getUser();

        if ($user === $comment->getAuthor()) {
            $form = $this->createForm(CommentFormType::class, $comment);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('app_stream_comment', ['id' => $track->getId()]);
            }

            return $this->render('stream/editcomment.html.twig', [
                'comment' => $comment,
                'track' => $track,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('common/error.html.twig', [
            'error' => 401,
            'message' => 'Unauthorized access',
        ]);
    }

    // DELETE COMMENT //

    /**
     * @IsGranted("ROLE_USER", statusCode=401, message="You have to be logged-in to access this ressource")
     * @Route("/deletecomment/{id<\d+>}", name="app_stream_deletecomment", methods={"POST"})
     */
    public function deletecomment(Request $request, Comment $comment): Response
    {
        $track = $comment->getTrack();
        $user = $this->security->getUser();
        if ($user === $comment->getAuthor()) {
            if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($comment);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_stream_comment', ['id' => $track->getId()]);
        }

        return $this->render('common/error.html.twig', [
            'error' => 401,
            'message' => 'Unauthorized acces',
        ]);
    }

    /**
     * @Route("/like/{id}", name="track_like")
     */
    public function like(Track $track, Request $request): Response
    {
        if ($request ->get('ajax')) {
            if ($track->getLikes()->contains($this->getUser())) {
                $track->removeLike($this->getUser());
                $this->getDoctrine()->getManager()->flush();
    
                return $this->json([
                    'liked' => false,
                    'code' => 200,
                    'likes' => count($track->getLikes()),
                ]);
    
                // return $this->redirectToroute('app_stream', ['id' => $track->getId()]);
            }
            $track->addLike($this->getUser());
            $this->getDoctrine()->getManager()->flush();
    
            return $this->json([
                'liked' => true,
                'code' => 200,
                'likes' => count($track->getLikes()),
            ]);
        }
        // return $this->redirectToroute('app_stream', ['id' => $track->getId()]);
    }
}
