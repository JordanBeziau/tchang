<?php
/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 10:50
 */

namespace AppBundle\Controller;


use AppBundle\Form\ProviderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class ProviderController extends Controller
{
  /**
   * @Route("/provider", name="provider")
   * @Method({"GET"})
   */
  public function displayProvidersAction()
  {
    $providers = $this->get('provider.service')->getProviders();
    return $this->render('@App/provider.html.twig', [
      'providers' => $providers
    ]);
  }

  /**
   * @Route("/provider/new", name="newProvider")
   * @Method({"GET","POST"})
   */
  public function createProviderAction(Request $request)
  {
    $form = $this->createForm(ProviderType::class);
    $form->handleRequest($request);

    if ($form->isValid() && $form->isSubmitted()) {
      $this->get('provider.service')->createProvider($form->getData());
    }

    return $this->render('@App/newProvider.html.twig', [
      'form' => $form->createView()
    ]);
  }
}