<?php

namespace NSDataRefinery\MonkeyIslandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use NSDataRefinery\MonkeyIslandBundle\Entity\Weapon;

class WeaponController extends CrudController
{

    private $mandatoryFields = array('name', 'power_level');
    protected $entity = 'NSDataRefineryMonkeyIslandBundle:Weapon';

    /**
     * Creating and storing a new wapon
     */
    public function createAction()
    {
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

        $object = new Weapon();
        $object->setName($params['name']);
        $object->setPowerLevel((int) $params['power_level']);

        $this->saveObject($object);

        return new JsonResponse(array('success' => TRUE, 'message' => 'Created weapon id ' . $object->getId()));
    }

    /**
     * Updates an existing weapon
     * @param $id
     */
    public function updateAction($id)
    {

        $object = $this->getObject($id);

        if (!$object) {
            return new JsonResponse(array('success' => FALSE, 'message' => 'No weapon found for id ' . $id), Response::HTTP_NOT_FOUND);
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
        $object->setPowerLevel((int) $params['power_level']);

        $this->saveObject($object);

        return new JsonResponse(array('success' => TRUE, 'message' => 'Updated weapon id ' . $object->getId()));
    }

    /**
     * Retrieves a weapon by it ID
     * @param $id
     */
    public function getAction($id)
    {
        $object = $this->getObject($id);

        if (!$object) {
            return new JsonResponse(array('success' => FALSE, 'message' => 'No weapon found for id ' . $id), Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($object->jsonSerialize());
    }

    /**
     * Deletes a weapon
     * @param $id
     */
    public function deleteAction($id)
    {
        $object = $this->getObject($id);

        if (!$object) {
            return new JsonResponse(
                array('success' => FALSE, 'message' => 'No weapon found for id ' . $id), 
                Response::HTTP_NOT_FOUND);
        }

        $this->removeObject($object);

        return new JsonResponse(array('success' => TRUE, 'message' => 'Weapon deleted'));
    }

}
