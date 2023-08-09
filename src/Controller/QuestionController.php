<?php

namespace App\Controller;

use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuestionController extends AbstractController
    {
    #[Route('/api/up/{id}', name: 'app_question_up', methods:['PATCH'])]
    public function upToScore(Question $question, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $question->setScore($question->getScore() + 1);
        $em->persist($question);
        $em->flush();

        return $this->json(json_decode($serializer->serialize($question, 'json')));
    }

    #[Route('/api/down/{id}', name: 'app_question_down', methods:['PATCH'])]
    public function downToScore(Question $question, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        $question->setScore($question->getScore() -1);
        $em->persist($question);
        $em->flush();

        return $this->json(json_decode($serializer->serialize($question, 'json')));
    }
} 