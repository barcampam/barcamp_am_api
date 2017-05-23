<?php

namespace ApiBundle\Controller;

use AdminBundle\Entity\Feedback;
use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/{lang}/schedule/actual", name="schedule_actual")
     * @Route("/{lang}/schedule/actual/{date}", name="schedule_actual_now")
     */
    public function scheduleActualAction($lang = null, $date = null)
    {
        if (is_null($date)) {
            $date = new \DateTime('now');
        } else {
            $date = new \DateTime($date);
        }
        $em = $this->getDoctrine()->getEntityManager();
        $result = $em->getRepository('AdminBundle:Schedule')->findActual($date);
        $data = [];
        foreach ($result as $slot) {
            array_push($data, $slot->serialize($lang));
        }


        $response = new JsonResponse($data);

        return $response;
    }


    /**
     * @Route("/schedule", name="schedule")
     * @Route("/{lang}/schedule", name="schedule_lang")
     * @Route("/{lang}/schedule/{day}", name="schedule_day")
     */
    public function scheduleAction($lang = null, $day = null)
    {
        $em = $this->getDoctrine()->getEntityManager();
        if ($day) {
            $result = $em->getRepository('AdminBundle:Schedule')->findByDay($day);
        } else {
            $result = $em->getRepository('AdminBundle:Schedule')->findBy([], ['timeTo' => 'ASC']);
        }


        $data = [];
        foreach ($result as $slot) {
            array_push($data, $slot->serialize($lang));
        }


        $response = new JsonResponse($data);
        return $response;
    }


    /**
     * @Route("/speakers", name="speakers")
     * @Route("/{lang}/speakers", name="speakers_lang")
     */
    public function speakersAction($lang = null)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $result = $em->getRepository('AdminBundle:Speaker')->findAll();

        $data = [];
        foreach ($result as $slot) {
            array_push($data, $slot->serialize($lang));
        }

        $response = new JsonResponse($data);
        return $response;
    }

    /**
     * @Route("/{lang}/speakers/special", name="special_speakers")
     */
    public function specialSpeakersAction($lang)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $result = $em->getRepository('AdminBundle:Speaker')->findBy(['isSpecial' => true]);

        $data = [];
        foreach ($result as $slot) {
            array_push($data, $slot->serialize($lang));
        }

        $response = new JsonResponse($data);
        return $response;
    }

    /**
     * @Route("/feedback", name="feedback")
     */
    public function feedbackAction(Request $request)
    {
        $fb = new Feedback();
        $fb->setBody($request->get('body'));
        $fb->setEmail($request->get('email'));

        $em = $this->getDoctrine()->getEntityManager();

        $em->persist($fb);
        $em->flush();

        $data = [
            'response' => 'ok'
        ];

        $response = new JsonResponse(json_encode($data));
        return $response;
    }
}
