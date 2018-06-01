<?php
/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 14:40
 */

namespace AppBundle\Service;


use AppBundle\Entity\Supply;
use Doctrine\ORM\EntityManager;

class SupplyService
{
  protected $doctrine;

  function __construct(EntityManager $doctrine)
  {
    $this->setDoctrine($doctrine);
  }

  public function displaySupplies()
  {
    return $this->getDoctrine()->getRepository(Supply::class)->findAll();
  }

  public function createSupply(Supply $data)
  {
    $data->setActive(1);
    $data->setCreatedAt(new \DateTime());
    $data->setUpdatedAt(new \DateTime());
    $this->getDoctrine()->persist($data);
    $this->getDoctrine()->flush();
  }

  public function updateSupply(Supply $data)
  {
    $data->setUpdatedAt(new \DateTime());
    $this->getDoctrine()->persist($data);
    $this->getDoctrine()->flush();
  }

  public function deleteSupply(Supply $id)
  {
    $this->getDoctrine()->remove($this->getDoctrine()->getRepository(Supply::class)->find($id));
    $this->getDoctrine()->flush();
  }

  /**
   * @return mixed
   */
  public function getDoctrine()
  {
    return $this->doctrine;
  }

  /**
   * @param mixed $doctrine
   */
  public function setDoctrine($doctrine)
  {
    $this->doctrine = $doctrine;
  }
}