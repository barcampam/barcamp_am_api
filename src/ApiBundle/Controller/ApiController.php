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
        $response = new Response(json_encode(['msg' => 'available urls are: /schedule, /speakers']));
        return $response;
    }

    /**
     * @Route("/schedule", name="schedule")
     */
    public function scheduleAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $result = $em->getRepository('AdminBundle:Schedule')->findAll();
        $data = [];
        foreach ($result as $slot) {
            array_push($data, $slot->serialize());
        }
        

        $response = new JsonResponse($data);
        return $response;
    }

    /**
     * @Route("/schedule/actual", name="schedule_actual")
     * @Route("/schedule/actual/{date}", name="schedule_actual_now")
     */
    public function scheduleActualAction($date = null)
    {
        if (is_null($date)) {
            $date = new \DateTime('now');
        }
        $em = $this->getDoctrine()->getEntityManager();
        $result = $em->getRepository('AdminBundle:Schedule')->findActual($date);
        $data = [];
        foreach ($result as $slot) {
            array_push($data, $slot->serialize());
        }
        

        $response = new JsonResponse($data);
        return $response;
    }

    /**
     * @Route("/speakers", name="speakers")
     */
    public function speakersAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $result = $em->getRepository('AdminBundle:Speaker')->findAll();

        $data = [];
        foreach ($result as $slot) {
            array_push($data, $slot->serialize());
        }

        $response = new JsonResponse($data);
        return $response;
    }
}
