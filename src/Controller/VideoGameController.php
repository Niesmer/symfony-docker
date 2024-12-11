<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\VideoGameType;
use App\Repository\VideoGameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VideoGameController extends AbstractController
{
    public function __construct(
        private readonly VideoGameRepository $videoGameRepository,
    ) {
    }

    #[Route('/video-game', name: 'app_video_game_index')]
    public function index(): Response
    {
        return $this->render('video_game/index.html.twig', [
            'games' => $this->videoGameRepository->findAll(),
        ]);
    }

    #[Route('/video-game/{id}', name: 'app_video_game_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(int $id): Response
    {
        $videoGame = $this->videoGameRepository->find($id);
        // De manière explicite on pourrait également utiliser
        // $this->videoGameRepository->findOneBy(['id' => $id]);

        if ($videoGame === null) {
            throw $this->createNotFoundException('Video game not found');
        }

        return $this->render('video_game/show.html.twig', [
            'game' => $videoGame,
        ]);

    }
    #[Route('/video-game/{id}', name: 'app_video_game_show', requirements: ['id' => '\d+'], methods: ['PATCH'])]
    public function edit(VideoGame $videoGame, Request $request): Response
    {
        $form = $this->createForm(VideoGameType::class, $videoGame);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            # code...
        }

        return $this->render('video_game/edit.html.twig', [
            'game' => $videoGame,
            'form' => $form->createView()
        ]);
    }
}

