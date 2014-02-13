<?php

namespace NSDataRefinery\MonkeyIslandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use NSDataRefinery\MonkeyIslandBundle\Entity\Ghost;

/**
 * Ghost related operations
 */
class GhostController extends Controller
{

    /**
     * Creates and lists random ghosts.
     * 
     * Ghosts are not persited into database. They dissappears after use.
     */
    public function listAction()
    {

        $alphabet = array_merge(range('a', 'z'), range('A', 'Z'), range('0', '9'));
        $alphabetMax = count($alphabet) - 1;
        $count = rand(1, 10);
        $json = array();
        for ($i = 0; $i < $count; $i++) {
            $object = new Ghost();
            $object->setId($i);

            $length = rand(1, 7);
            $name = '';
            for ($j = 0; $j < $length; $j++) {
                $name .= $alphabet[rand(0, $alphabetMax)];
            }
            $object->setName($name);

            $json[] = $object->jsonSerialize();
        }

        return new JsonResponse($json);
    }

}
