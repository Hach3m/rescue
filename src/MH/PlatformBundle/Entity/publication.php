<?php

namespace MH\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="MH\PlatformBundle\Repository\publicationRepository")
 */
class publication
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAjout", type="datetimetz")
     */
    private $dateAjout;

    /**
    *@ORM\ManyToMany(targetEntity="MH\PlatformBundle\Entity\animal")
   */
   private $animals;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return publication
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return publication
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->animals = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add animal
     *
     * @param \MH\PlatformBundle\Entity\animal $animal
     *
     * @return publication
     */
    public function addAnimal(\MH\PlatformBundle\Entity\animal $animal)
    {
        $this->animals[] = $animal;

        return $this;
    }

    /**
     * Remove animal
     *
     * @param \MH\PlatformBundle\Entity\animal $animal
     */
    public function removeAnimal(\MH\PlatformBundle\Entity\animal $animal)
    {
        $this->animals->removeElement($animal);
    }

    /**
     * Get animals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnimals()
    {
        return $this->animals;
    }
}
