<?php

namespace NSDataRefinery\MonkeyIslandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Collection of common helper methods for controllers
 */
class CrudController extends Controller
{

    /**
     * The persistency manager
     */
    protected $em;

    /**
     * Checks input parameters
     * @param $params
     *   The list of input parameters as an associative array
     * @param $mandatory
     *   The list of mandatory fields
     */
    protected function checkParams($params, $mandatory = array())
    {
        $errors = array();
        foreach ($mandatory as $field)
        {
            if (!isset($params[$field]) || empty($params[$field])) {
                $errors[] = $field;
            }
        }
        if (!empty($errors))
        {
            return array(
                'success' => FALSE,
                'message' => 'The JSON input misses mandatory field(s): ' . join($errors, ', ')
            );
        }

        return FALSE;
    }

    /**
     * Gets the Doctrine persistency manager
     */
    protected function getManager()
    {
        if ($this->em == NULL) {
            $this->em = $this->getDoctrine()->getManager();
        }
        return $this->em;
    }

    /**
     * Reads an object
     * @param $id
     */
    protected function getObject($id)
    {
        return $this->getManager()->getRepository($this->entity)->find($id);
    }

    /**
     * Saves an object
     * @param $object
     */
    protected function saveObject($object)
    {
        $em = $this->getManager();
        $em->persist($object);
        $em->flush();
    }

    /**
     * Remove an object
     * @param $object
     */
    protected function removeObject($object)
    {
        $em = $this->getManager();
        $em->remove($object);
        $em->flush();
    }

    /**
     * List of all objects
     */
    public function listAction()
    {
        $objects = $this->getManager()->getRepository($this->entity)->findAll();

        $json = array();
        foreach ($objects as $object) {
            $json[] = $object->jsonSerialize();
        }

        return new JsonResponse($json);
    }
}
