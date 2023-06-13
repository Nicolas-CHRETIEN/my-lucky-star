<?php

namespace App\Controller;


use DateTime;
use App\Entity\User;
use App\Entity\Stars;
use App\Entity\Images;
use DateTimeInterface;
use App\Entity\Answers;
use App\Entity\Comment;
use App\Form\ImageType;
use App\Form\CreateStarType;
use App\Form\CommentStarType;
use App\Form\AnswerCommentType;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\StarsRepository;
use App\Repository\ImagesRepository;
use App\Repository\AnswersRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CommentsController extends AbstractController {

    // ----------------------- Add comment. ---------------------------
    /**
    * @Route("/stars/{id}/comment", name="star_comment")
    * @Security("is_granted('IS_AUTHENTICATED_FULLY')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param EntityManagerInterface $manager
    * @return response
    */

    public function addComment ($id, Request $request, EntityManagerInterface $manager, CommentRepository $comment_repository, StarsRepository $star_repository): Response {
        $comment = new comment;
        $form = $this->createForm(CommentStarType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $star = $star_repository->findOneById($id);
            $comment->setUserId($user);
            $comment->setStarId($star);
            $date = new DateTime('@'. strtotime('now'));
            $comment->setDate($date);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('app_stars_knowmore', ['id' => $star->getId()]);
        }
        $star = $star_repository->findOneById($id);
        $comments = $comment_repository->findAll();
        return $this->render('comments/commentAdd.html.twig', ['form' => $form->createView(), 'comments' => $comments, 'star' => $star]);
    }

    // ----------------------- Edit comment. ---------------------------
    /**
    * @Route("/stars/{starId}/comment/{id}/edit", name="comment_edit")
    * @Security("is_granted('ROLE_ADMIN')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param $id
    * @param $starId
    * @param Request $request
    * @param EntityManagerInterface $manager
    * @param CommentRepository $comment_repository
    * @param StarsRepository $star_repository
    * @return Response
    */

    public function editComment ($id, $starId, Request $request, EntityManagerInterface $manager, CommentRepository $comment_repository, StarsRepository $star_repository) {
        $comment = $comment_repository->findOneById($id);
        $form = $this->createForm(CommentStarType::class, $comment);
        $star = $star_repository->findOneById($starId);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $star = $star_repository->findOneById($id);
            $date = new DateTime('@'. strtotime('now'));
            $comment->setEdit($date);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('app_stars_knowmore', ['id' => $starId]);
        }

        $comments = $comment_repository->findAll();
        return $this->render('comments/commentEdit.html.twig', ['form' => $form->createView(),'comment' => $comment, 'comments' => $comments, 'star' => $star, 'commentToEdit' => $comment]);
    }

    // ----------------------- Delete comment. ---------------------------
    /**
    * @Route("/stars/{starId}/comment/{id}/delete", name="comment_delete")
    * @Security("is_granted('ROLE_ADMIN')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param $id
    * @param $starId
    * @param EntityManagerInterface $manager
    * @param CommentRepository $comment_repository
    * @param StarsRepository $star_repository
    * @return Response
    */

    public function removeComment($id, $starId, EntityManagerInterface $manager, CommentRepository $comment_repository) {
        $comment = $comment_repository->findOneById($id);
        $manager->remove($comment);
        $manager->flush();
        $comments = $comment_repository->findAll();
        return $this->redirectToRoute('app_stars_knowmore', ['id' => $starId]);
    }

    // ----------------------- Answer comment. ---------------------------
    /**
    * @Route("/stars/{id}/comment/{commentId}", name="answer_comment")
    * @Security("is_granted('IS_AUTHENTICATED_FULLY')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param EntityManagerInterface $manager
    * @return response
    */

    public function answerComment ($id, $commentId, Request $request, EntityManagerInterface $manager, CommentRepository $comment_repository, StarsRepository $star_repository, AnswersRepository $answers_repository): Response {
        $answer = new Answers;
        $commentTarget = $comment_repository->findOneById($commentId);
        $form = $this->createForm(AnswerCommentType::class, $answer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $star = $star_repository->findOneById($id);
            $answer->setUserId($user);
            $answer->setTarget("comment");
            $answer->setTargetName($commentTarget->getUserId()->getFirstname() . " " . $commentTarget->getUserId()->getLastname());
            $answer->setComment($commentTarget);
            $date = new DateTime('@'. strtotime('now'));
            $answer->setDate($date);
            $manager->persist($answer);
            $manager->flush();

            return $this->redirectToRoute('app_stars_knowmore', ['id' => $star->getId()]);
        }
        $star = $star_repository->findOneById($id);
        $comments = $comment_repository->findAll();
        $answers = $answers_repository->findAll();
        return $this->render('comments/commentAnswer.html.twig', ['form' => $form->createView(), 'comments' => $comments, 'star' => $star, 'commentTarget' => $commentTarget, 'answers' => $answers, 'target' => 'comment']);
    }

    // ----------------------- Edit answer. ---------------------------
    /**
    * @Route("/stars/{starId}/comment/{commentId}/answer/{answerId}/edit", name="answer_edit")
    * @Security("is_granted('ROLE_ADMIN')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param $id
    * @param $starId
    * @param Request $request
    * @param EntityManagerInterface $manager
    * @param CommentRepository $comment_repository
    * @param StarsRepository $star_repository
    * @return Response
    */

    public function editAnswer ($starId, $commentId, $answerId, Request $request, EntityManagerInterface $manager, AnswersRepository $answers_repository, CommentRepository $comment_repository, StarsRepository $star_repository) {
        $answer = $answers_repository->findOneById($answerId);
        $comment = $comment_repository->findOneById($commentId);
        $star = $star_repository->findOneById($starId);
        $form = $this->createForm(AnswerCommentType::class, $answer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new DateTime('@'. strtotime('now'));
            $comment->setEdit($date);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('app_stars_knowmore', ['id' => $starId]);
        }

        $comments = $comment_repository->findAll();
        return $this->render('comments/answerEdit.html.twig', ['form' => $form->createView(),'answer' => $answer, 'comments' => $comments, 'star' => $star, 'commentTarget' => $comment, 'targetAnswer' => $answer]);
    }

    // ----------------------- Delete answer. ---------------------------
    /**
    * @Route("/stars/{starId}/comment/{commentId}/answer/{answerId}/delete", name="answer_delete")
    * @Security("is_granted('ROLE_ADMIN')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param $id
    * @param $starId
    * @param EntityManagerInterface $manager
    * @param CommentRepository $comment_repository
    * @param StarsRepository $star_repository
    * @return Response
    */

    public function removeAnswer ($starId, $commentId, $answerId, EntityManagerInterface $manager, AnswersRepository $answers_repository) {
        $answer = $answers_repository->findOneById($answerId);
        $manager->remove($answer);
        $manager->flush();
        return $this->redirectToRoute('app_stars_knowmore', ['id' => $starId]);
    }

    // ----------------------- Answer answer. ---------------------------
    /**
    * @Route("/stars/{starId}/{commentId}/{answerId}/answer", name="answer_answer")
    * @Security("is_granted('IS_AUTHENTICATED_FULLY')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param EntityManagerInterface $manager
    * @return response
    */

    public function answerAnswer ($starId, $commentId, $answerId, Request $request, EntityManagerInterface $manager, CommentRepository $comment_repository, StarsRepository $star_repository, AnswersRepository $answers_repository): Response {
        $answer = new Answers;
        $comment = $comment_repository->findOneById($commentId);
        $form = $this->createForm(AnswerCommentType::class, $answer);
        $targetAnswer = $answers_repository->findOneById($answerId);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $star = $star_repository->findOneById($starId);
            $answer->setUserId($user);
            $answer->setTarget("answer");
            $answer->setTargetName($targetAnswer->getUserId()->getFirstname() . " " . $targetAnswer->getUserId()->getLastname());
            $answer->setComment($comment);
            $date = new DateTime('@'. strtotime('now'));
            $answer->setDate($date);
            $manager->persist($answer);
            $manager->flush();

            return $this->redirectToRoute('app_stars_knowmore', ['id' => $star->getId()]);
        }
        $star = $star_repository->findOneById($starId);
        $comments = $comment_repository->findAll();
        $answers = $answers_repository->findAll();
        return $this->render('comments/commentAnswer.html.twig', ['form' => $form->createView(), 'comments' => $comments, 'star' => $star, 'comment' => $comment, 'answers' => $answers, 'target' => 'answer', 'commentTarget' => '', 'targetAnswer' => $targetAnswer]);
    }
}
