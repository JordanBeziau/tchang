<?php
/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 09:40
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Supply;
use AppBundle\Form\SupplyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SupplyController extends Controller
{
  /**
   * @Route("/supply", name="supply")
   * @Route("/supply/delete/{id}", name="removeSupply", defaults={"id":null})
   * @Method({"GET"})
   */
  public function indexAction(Supply $id = null)
  {
    if ($id)
      $this->get('supply.service')->deleteSupply($id);

    return $this->render('@App/supply.html.twig', [
      'supplies' => $this->get('supply.service')->displaySupplies()
    ]);
  }

  /**
   * @Route("/supply/new", name="newSupply")
   * @Method({"GET", "POST"})
   */
  public function createSupplyAction(Request $request)
  {
    $form = $this->createForm(SupplyType::class);
    $form->remove('active');
    $form->handleRequest($request);

    if ($form->isValid() && $form->isSubmitted()) {
      $this->get('supply.service')->createSupply($form->getData());
      return $this->redirectToRoute('supply');
    }

    return $this->render('@App/newSupply.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/supply/edit/{id}", name="editSupply", defaults={"id":null})
   * @Method({"GET","POST"})
   */
  public function updateSupplyAction(Request $request, Supply $id)
  {
    $form = $this->createForm(SupplyType::class, $id);
    $form->handleRequest($request);

    if ($form->isValid() && $form->isSubmitted()) {
      $this->get('supply.service')->updateSupply($id);
      return
        $this->redirectToRoute('supply');
    }

    return $this->render('@App/editSupply.html.twig', [
      'form' => $form->createView()
    ]);
  }
}
