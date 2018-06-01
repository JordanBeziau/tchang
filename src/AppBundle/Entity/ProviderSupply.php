<?php

/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 10:17
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ProviderSupply
 * @ORM\Entity
 * @ORM\Table(name="provider_supply")
 */
class ProviderSupply
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Provider", inversedBy="provider_supply")
   */
  protected $idProvider;

  /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Supply", inversedBy="supply_provider")
   */
  protected $idSupply;

  /**
   * @ORM\Column(name="created_at", type="datetime", nullable=false)
   */
  protected $createdAt;
}