<?php

namespace NSDataRefinery\MonkeyIslandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use NSDataRefinery\MonkeyIslandBundle\Entity\Dog;

/**
 * Controller for dog-related operations.
 */
class DogController extends CrudController
{

    private $mandatoryFields = array('name', 'energy_level');
    protected $entity = 'NSDataRefineryMonkeyIslandBundle:Dog';

    /**
     * Creates and stores a new dog
     * @param $id
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

        $object = new Dog();
        $object->setName($params['name']);
        $object->setEnergyLevel((int) $params['energy_level']);


        $this->saveObject($object);

        return new JsonResponse(array('success' => TRUE, 'message' => 'Created dog id ' . $object->getId()));
    }

    /**
     * Updates an existing dog
     * @param $id
     */
    public function updateAction($id)
    {

        $object = $this->getObject($id);

        if (!$object) {
            return new JsonResponse(array('success' => FALSE, 'message' => 'No dog found for id ' . $id), Response::HTTP_NOT_FOUND);
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

        return new JsonResponse(array('success' => TRUE, 'message' => 'Updated dog id ' . $object->getId()));
    }

    /**
     * Returns a dog by its ID
     * @param $id
     */
    public function getAction($id)
    {
        $object = $this->getObject($id);

        if (!$object) {
            return new JsonResponse(array('success' => FALSE, 'message' => 'No dog found for id ' . $id), Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($object->jsonSerialize());
    }

    /**
     * Deletes a dog
     * @param $id
     */
    public function deleteAction($id)
    {
        $object = $this->getObject($id);

        if (!$object) {
            return new JsonResponse(array('success' => FALSE, 'message' => 'No dog found for id ' . $id), Response::HTTP_NOT_FOUND);
        }

        $this->removeObject($object);

        return new JsonResponse(array('success' => TRUE, 'message' => 'Dog deleted'));
    }

}
