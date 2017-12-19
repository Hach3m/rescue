<?php

namespace MH\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * animal
 *
 * @ORM\Table(name="animal")
 * @ORM\Entity(repositoryClass="MH\PlatformBundle\Repository\animalRepository")
 */
class animal
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="datetimetz", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="ageApproximatif", type="string", length=255)
     */
    private $ageApproximatif;

    /**
     * @var bool
     *
     * @ORM\Column(name="etat", type="boolean")
     */
    private $etat;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return animal
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return animal
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set ageApproximatif
     *
     * @param string $ageApproximatif
     *
     * @return animal
     */
    public function setAgeApproximatif($ageApproximatif)
    {
        $this->ageApproximatif = $ageApproximatif;

        return $this;
    }

    /**
     * Get ageApproximatif
     *
     * @return string
     */
    public function getAgeApproximatif()
    {
        return $this->ageApproximatif;
    }

    /**
     * Set etat
     *
     * @param boolean $etat
     *
     * @return animal
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return bool
     */
    public function getEtat()
    {
        return $this->etat;
    }
}