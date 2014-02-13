<?php

namespace NSDataRefinery\MonkeyIslandBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

abstract class CuddlyToy implements JsonSerializable
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $energy_level;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return CuddlyToy
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set energy_level
     *
     * @param integer $energyLevel
     * @return CuddlyToy
     */
    public function setEnergyLevel($energyLevel)
    {
        $this->energy_level = $energyLevel;

        return $this;
    }

    /**
     * Get energy_level
     *
     * @return integer
     */
    public function getEnergyLevel()
    {
        return $this->energy_level;
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'energy_level' => $this->energy_level
        );
    }
}
