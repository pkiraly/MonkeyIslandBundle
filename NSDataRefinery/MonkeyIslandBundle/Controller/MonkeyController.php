<?php

namespace NSDataRefinery\MonkeyIslandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use NSDataRefinery\MonkeyIslandBundle\Entity\Monkey;

class MonkeyController extends CrudController
{

    private $mandatoryFields = array('name', 'energy_level');
    protected $entity = 'NSDataRefineryMonkeyIslandBundle:Monkey';

    /**
     * Creates and stores a new monkey
     */
    public function createAction()
    {
        $params = array();
        $content = $this->get("request")->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);
        }

        $errors = $this->checkParams($params, $this->mandatoryFields);
        if ($errors !== FALSE) {
            return new JsonResponse($errors, Response::HTTP_CONFLICT);
        }

        $object = new Monkey();
        $object->setName($params['name']);
        $object->setEnergyLevel((int) $params['energy_level']);

        $this->saveObject($object);

        return new JsonResponse(array('success' => TRUE, 'message' => 'Created monkey id ' . $object->getId()));
    }

    /**
     * Updates an existing monkey
     * @param $id
     */
    public function updateAction($id)
    {

        $object = $this->getObject($id);

        if (!$object) {
            return new JsonResponse(array('success' => FALSE, 'message' => 'No monkey found for id ' . $id), Response::HTTP_NOT_FOUND);
        }

        $params = array();
        $content = $this->get("request")->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true); // 2nd param to get as array
        }

        $errors = $this->checkParams($params, $this->mandatoryFields);
        if ($errors !== FALSE) {
            return new JsonResponse($errors, Response::HTTP_CONFLICT);
        }

        $object->setName($params['name']);
        $object->setEnergyLevel((int) $params['energy_level']);

        $this->saveObject($object);

        return new JsonResponse(array('success' => TRUE, 'message' => 'Updated monkey id ' . $object->getId()));
    }

    /**
     * Retrieves a monkey by its ID
     * @param $id
     */
    public function getAction($id)
    {
        $object = $this->getObject($id);

        if (!$object) {
            return new JsonResponse(array('success' => FALSE, 'message' => 'No monkey found for id ' . $id), Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($object->jsonSerialize());
    }

    /**
     * Deletes a monkey
     * @param $id
     */
    public function deleteAction($id)
    {
        $object = $this->getObject($id);

        if (!$object) {
            return new JsonResponse(array('success' => FALSE, 'message' => 'No monkey found for id ' . $id), Response::HTTP_NOT_FOUND);
        }

        $this->removeObject($object);

        return new JsonResponse(array('success' => TRUE, 'message' => 'Monkey deleted'));
    }

}
