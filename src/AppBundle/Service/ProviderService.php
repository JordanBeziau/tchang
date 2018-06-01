<?php

/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 11:37
 */
namespace AppBundle\Service;

use AppBundle\Entity\Provider;
use Doctrine\ORM\EntityManager;

class ProviderService
{
  protected $doctrine;

  function __construct(EntityManager $doctrine)
  {
    $this->setDoctrine($doctrine);
  }

  public function getProviders()
  {
    return $this->getDoctrine()->getRepository(Provider::class)->findAll();
  }

  public function createProvider(Provider $data)
  {
    $data->setActive(1);
    $data->setCreatedAt(new \DateTime());
    $data->setUpdatedAt(new \DateTime());
    $this->getDoctrine()->persist($data);
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