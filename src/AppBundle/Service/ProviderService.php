<?php

/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 11:37
 */
namespace AppBundle\Service;

use AppBundle\Entity\Provider;
use AppBundle\Entity\ProviderSupply;
use AppBundle\Entity\Supply;
use Doctrine\ORM\EntityManager;

class ProviderService
{
  private $doctrine;
  private $relationExist;

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

  public function updateProvider(Provider $data)
  {
    $data->setUpdatedAt(new \DateTime());
    $this->getDoctrine()->persist($data);
    $this->getDoctrine()->flush();
  }

  public function deleteProvider(Provider $id)
  {
    $this->getDoctrine()->remove($this->getDoctrine()->getRepository(ProviderSupply::class)->findBy(['idProvider' => $id]));
    $this->getDoctrine()->remove($this->getDoctrine()->getRepository(Provider::class)->find($id));
    $this->getDoctrine()->flush();
  }

  public function joinRequest($id)
  {
    if ($id)
      return $this->relationExist = $this->getDoctrine()->getRepository(ProviderSupply::class)->findBy(['idProvider' => $id]);
    return [];
  }

  public function registerProviderSupply($item, $data)
  {
    $newProviderSupply = new ProviderSupply();
    $newProviderSupply->setCreatedAt(new \DateTime());
    $newProviderSupply->setIdProvider($data);
    $newProviderSupply->setIdSupply($this->registerIdSupply($item));
    $this->getDoctrine()->persist($newProviderSupply);
    $this->getDoctrine()->flush();
  }

  public function registerIdSupply($item)
  {
    return $this->getDoctrine()->getRepository(Supply::class)->findOneBy(['id' => $item]);
  }


  public function handleRelation(Provider $provider, Array $formData)
  {
    $providerSupply = $this->joinRequest($provider->getId());
    foreach($providerSupply as $ps) {
      $find = array_search($ps->getIdSupply()->getId(), $formData['providerSupply']);
      if ($find !== false) {
        unset($formData['providerSupply'][$find]);
      } else {
        $this->doctrine->remove($ps);
        $this->doctrine->flush();
      }
    }
    return $formData;
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