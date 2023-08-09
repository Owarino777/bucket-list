<?php

namespace App\Controller;

use App\Form\BucketType;
use App\Entity\Bucket;
use App\Repository\BucketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bucket', name: 'bucket_')]

class BucketController extends AbstractController
{
    #[Route('', name: 'list')]
    public function list(BucketRepository $bucketRepository): Response
    {
        //$bucket = $bucketRepository->findBy([], ['popularity' => 'DESC', 'vote' => 'DESC'], limit: 30);
        $bucket = $bucketRepository->findBestBucket();

        return $this->render('bucket/list.html.twig', [
            "bucket" => $bucket
        ]);
    }

    #[Route('/details/{id}', name: 'details')]
    public function details(int $id, BucketRepository $bucketRepository): Response
    {
        $buckete = $bucketRepository->find($id);


        return $this->render('bucket/details.html.twig', [
            "serie" => $buckete
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {

        $bucket = new Bucket();
        $bucket->setDateCreated(new \DateTime());

        $bucketForm = $this->createForm(BucketType::class, $bucket);

        $bucketForm->handleRequest($request);

        if ($bucketForm->isSubmitted()) {
            $entityManager->persist($bucket);
            $entityManager->flush();

            $this->addFlash('succes', 'Serie added! Good job.');
            return $this->redirectToRoute('bucket_details', ['id' => $bucket->getId()]);
        }

        return $this->render('bucket/create.html.twig', [
            'bucketForm' => $bucketForm->createView()
        ]);
    }

    #[Route('/demo', name: "em-demo")]
    public function demo(EntityManagerInterface $entityManager): Response
    {
        //crée une instance de mon entité
        $bucket = new Bucket();

        //hydrate toutes les propriétés
        $bucket->setName('pif');
        $bucket->setBackdrop('dafsd');
        $bucket->setPoster('dafsdf');
        $bucket->setDateCreated(new \DateTime());
        $bucket->setFirstAirDate(new \DateTime("- 1 year"));
        $bucket->setLastAirDate(new \DateTime("- 6 month"));
        $bucket->setGenres('drama');
        $bucket->setOverview('bla bla bla');
        $bucket->setPopularity('123.00');
        $bucket->setVote('8.2');
        $bucket->setStatus('Canceled');
        $bucket->setTmdbId('329432');

        dump($bucket);

        //pour injecter les donnée en base
        $entityManager->persist($bucket);
        $entityManager->flush();

        dump($bucket);
        //pour supprimer les donnée
        //$entityManager->remove($bucket);


        //pour modifier les donnée
        $bucket->setGenres('comedy');
        $entityManager->flush();

        //$entityManager = $this->getDoctrine()->getManager();


        return $this->render('bucket/create.html.twig', []);
    }
}
