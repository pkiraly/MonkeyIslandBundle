<?php

namespace NSDataRefinery\MonkeyIslandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller for cuddy toys operations.
 */
class CuddlyToyController extends Controller
{

    /**
     * Listing all cuddly toys
     */
    public function listAction()
    {
        $json = array();

        $objects = $this->getDoctrine()
            ->getRepository('NSDataRefineryMonkeyIslandBundle:Dog')
            ->findAll();

        if ($objects) {
            $json['dogs'] = array();
            foreach ($objects as $object) {
                $json['dogs'][] = $object->jsonSerialize();
            }
        }

        $objects = $this->getDoctrine()
            ->getRepository('NSDataRefineryMonkeyIslandBundle:Monkey')
            ->findAll();

        if ($objects) {
            $json['monkeys'] = array();
            foreach ($objects as $object) {
                $json['monkeys'][] = $object->jsonSerialize();
            }
        }

        return new JsonResponse($json);
    }

}
