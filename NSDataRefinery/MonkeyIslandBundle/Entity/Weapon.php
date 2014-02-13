<?php

namespace NSDataRefinery\MonkeyIslandBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="weapon")
 */
class Weapon implements JsonSerializable
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
    protected $power_level;


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
     * @return Weapon
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
     * Set power_level
     *
     * @param integer $powerLevel
     * @return Weapon
     */
    public function setPowerLevel($powerLevel)
    {
        $this->power_level = $powerLevel;

        return $this;
    }

    /**
     * Get power_level
     *
     * @return integer
     */
    public function getPowerLevel()
    {
        return $this->power_level;
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'power_level' => $this->power_level
        );
    }

}
