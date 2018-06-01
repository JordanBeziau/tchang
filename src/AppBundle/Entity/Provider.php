<?php

/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 09:57
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Provider
 * @ORM\Entity
 * @ORM\Table(name="provider")
 */
class Provider
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProviderSupply", mappedBy="idProvider")
   */
  protected $provider_supply;

  /**
   * @ORM\Column(name="name", type="string", length=50, nullable=false)
   */
  protected $name;

  /**
   * @ORM\Column(name="address", type="string", length=255, nullable=false)
   */
  protected $address;

  /**
   * @ORM\Column(name="siret", type="integer", length=16, nullable=false)
   */
  protected $siret;

  /**
   * @ORM\Column(name="active", type="boolean", nullable=false)
   */
  protected $active;

  /**
   * @ORM\Column(name="created_at", type="datetime", nullable=false)
   */
  protected $createdAt;

  /**
   * @ORM\Column(name="updated_at", type="datetime", nullable=false)
   */
  protected $updatedAt;

  function __toString()
  {
    return $this->name;
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @return mixed
   */
  public function getAddress()
  {
    return $this->address;
  }

  /**
   * @param mixed $address
   */
  public function setAddress($address)
  {
    $this->address = $address;
  }

  /**
   * @return mixed
   */
  public function getSiret()
  {
    return $this->siret;
  }

  /**
   * @param mixed $siret
   */
  public function setSiret($siret)
  {
    $this->siret = $siret;
  }

  /**
   * @return mixed
   */
  public function getActive()
  {
    return $this->active;
  }

  /**
   * @param mixed $active
   */
  public function setActive($active)
  {
    $this->active = $active;
  }

  /**
   * @return mixed
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * @param mixed $createdAt
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;
  }

  /**
   * @return mixed
   */
  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }

  /**
   * @param mixed $updatedAt
   */
  public function setUpdatedAt($updatedAt)
  {
    $this->updatedAt = $updatedAt;
  }
}