<?php

/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 10:09
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Supply
 * @ORM\Entity
 * @ORM\Table(name="supply")
 */
class Supply
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProviderSupply", mappedBy="idSupply")
   */
  protected $supply_provider;

  /**
   * @ORM\Column(name="name", type="string", length=50, nullable=false)
   */
  protected $name;

  /**
   * @ORM\Column(name="active", type="smallint", length=1, nullable=false)
   */
  protected $active;

  /**
   * @ORM\Column(name="buying_price", type="float", nullable=false)
   */
  protected $buyingPrice;

  /**
   * @ORM\Column(name="selling_price", type="float", nullable=false)
   */
  protected $sellingPrice;

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
  public function getBuyingPrice()
  {
    return $this->buyingPrice;
  }

  /**
   * @param mixed $buyingPrice
   */
  public function setBuyingPrice($buyingPrice)
  {
    $this->buyingPrice = $buyingPrice;
  }

  /**
   * @return mixed
   */
  public function getSellingPrice()
  {
    return $this->sellingPrice;
  }

  /**
   * @param mixed $sellingPrice
   */
  public function setSellingPrice($sellingPrice)
  {
    $this->sellingPrice = $sellingPrice;
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