<?php
/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 09:40
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SupplyController extends Controller
{
  /**
   * @Route("/supply", name="supply")
   * @Method({"GET"})
   */
  public function indexAction()
  {
    return $this->render('@App/supply.html.twig');
  }
}
