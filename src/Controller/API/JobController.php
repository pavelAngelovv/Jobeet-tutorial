<?php

namespace App\Controller\API;

use App\Entity\Affiliate;
use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Response;

class JobController extends FOSRestController
{
    /**
     * @Rest\Get("/jobs/{token}", name="api.job.list")
     *
     * @Entity("affiliate", expr="repository.findOneActiveByToken(token)")
     *
     * @param Affiliate $affiliate
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function getJobsAction(Affiliate $affiliate, EntityManagerInterface $em) : Response
    {
        /** @var \App\Repository\JobRepository $jobRepository */
        $jobRepository = $em->getRepository(Job::class);
        $jobs = $jobRepository->findActiveJobsForAffiliate($affiliate);

        return $this->handleView($this->view($jobs, Response::HTTP_OK));
    }
    }
