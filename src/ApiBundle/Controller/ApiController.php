<?php

namespace ApiBundle\Controller;

use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $response = new Response(json_encode(['msg' => 'available urls are: /json/schedule, /json/speakers']));
        return $response;
    }

    /**
     * @Route("/schedule", name="schedule")
     */
    public function scheduleAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $result = $em->getRepository('AdminBundle:Schedule')->findAll();

        $serializer = SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($result, 'json');

        $response = new JsonResponse($jsonContent);
        return $response;
    }

    /**
     * @Route("/speakers", name="speakers")
     */
    public function speakersAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $result = $em->getRepository('AdminBundle:Speaker')->findAll();

        $serializer = SerializerBuilder::create()->build();
        $jsonContent = $serializer->serialize($result, 'json');

        $response = new JsonResponse($jsonContent);
        return $response;
    }
}
