<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ServiceRepository;
use App\Repository\ProjectRepository;
use App\Repository\WorkStageRepository;
use App\Repository\WorkValueRepository;

class HomeController extends AbstractController
{
    public function index(
        ServiceRepository $serviceRepository,
        ProjectRepository $projectRepository,
        WorkStageRepository $workStageRepository,
        WorkValueRepository $workValueRepository
    ): Response
    {
        $services = $serviceRepository->findAllSortedBySort();
        $projects = $projectRepository->findAllSortedBySort();
        $workStages = $workStageRepository->findAllSortedBySort();
        $workValues = $workValueRepository->findAllSortedBySort();

        return $this->render('home/index.html.twig', [
            'projects' => $projects,
            'services' => $services,
            'workStages' => $workStages,
            'workValues' => $workValues,
        ]);
    }
}
