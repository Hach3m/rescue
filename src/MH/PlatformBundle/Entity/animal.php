<?php

namespace MH\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255,options={"default" : "Sain"})
     * @Assert\Choice({"Perdu", "Malade","Adoption"})
     */
    private $etat;


     /**
     *@ORM\ManyToOne(targetEntity="MH\PlatformBundle\Entity\categorie")
     *@ORM\JoinColumn(nullable=false)
    */
    private $categorie;


     /**
     *@ORM\ManyToOne(targetEntity="MH\PlatformBundle\Entity\race")
     *@ORM\JoinColumn(nullable=false)
    */
    private $race;
    /**
    *@ORM\ManyToOne(targetEntity="MH\UserBundle\Entity\User")
    *@ORM\JoinColumn(nullable=false)
   */
   private $user;
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

    /**
     * Set categorie
     *
     * @param \MH\PlatformBundle\Entity\categorie $categorie
     *
     * @return animal
     */
    public function setCategorie(\MH\PlatformBundle\Entity\categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \MH\PlatformBundle\Entity\categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set race
     *
     * @param \MH\PlatformBundle\Entity\race $race
     *
     * @return animal
     */
    public function setRace(\MH\PlatformBundle\Entity\race $race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return \MH\PlatformBundle\Entity\race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set user
     *
     * @param \MH\UserBundle\Entity\User $user
     *
     * @return animal
     */
    public function setUser(\MH\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MH\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
