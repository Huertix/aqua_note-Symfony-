<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenusRespository")
 * @ORM\Table(name="genus")
 */
class Genus {
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @Assert\NotBlank()
   * @ORM\Column(type="string")
   */
  private $name;

  /**
   * @Assert\NotBlank()
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SubFamily")
   * @ORM\JoinColumn(nullable=false)
   */
  private $subFamily;

  /**
   * @Assert\NotBlank()
   * @Assert\Range(min=0, minMessage="Negative species! Come on...")
   * @ORM\Column(type="integer")
   */
  private $speciesCount;

  /**
   * @ORM\Column(type="string", nullable=true)
   */
  private $funFact;

  /**
   * @ORM\Column(type="boolean")
   */
  private $isPublished = TRUE;

  /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\GenusNote", mappedBy="genus")
   * @ORM\OrderBy({"createdAt" = "DESC"})
   */
  private $notes;

  /**
   * @Assert\NotBlank()
   * @ORM\Column(type="date")
   */
  private $firstDiscoveredAt;


  public function __construct() {
    $this->notes = new ArrayCollection();
  }

  /**
   * @return mixed
   */
  public function getSubFamily() {
    return $this->subFamily;
  }

  /**
   * @param mixed $subFamily
   */
  public function setSubFamily($subFamily) {
    $this->subFamily = $subFamily;
  }

  /**
   * @return mixed
   */
  public function getSpeciesCount() {
    return $this->speciesCount;
  }

  /**
   * @param mixed $speciesCount
   */
  public function setSpeciesCount($speciesCount) {
    $this->speciesCount = $speciesCount;
  }

  /**
   * @return mixed
   */
  public function getFunFact() {
    return $this->funFact;
  }

  /**
   * @param mixed $funFact
   */
  public function setFunFact($funFact) {
    $this->funFact = $funFact;
  }


  /**
   * @return mixed
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name) {
    $this->name = $name;
  }

  public function getUpdatedAt() {
    return new \DateTime('-' . rand(0, 100) . ' days');
  }

  public function setIsPublished($isPublished) {
    $this->isPublished = $isPublished;
  }

  public function getIsPublished() {
    return $this->isPublished;
  }


  /**
   * @return ArrayCollection|GenusNote[]
   */
  public function getNotes() {
    return $this->notes;
  }

  /**
   * @return mixed
   */
  public function getFirstDiscoveredAt() {
    return $this->firstDiscoveredAt;
  }

  /**
   * @param mixed $firstDiscoveredAt
   */
  public function setFirstDiscoveredAt($firstDiscoveredAt) {
    $this->firstDiscoveredAt = $firstDiscoveredAt;
  }


}