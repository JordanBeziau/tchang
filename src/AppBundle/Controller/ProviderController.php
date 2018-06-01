<?php
/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 10:50
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Provider;
use AppBundle\Form\ProviderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class ProviderController extends Controller
{
  /**
   * @Route("/provider", name="provider")
   * @Route("/provider/delete/{id}", name="removeProvider", defaults={"id":null})
   * @Method({"GET"})
   */
  public function displayProvidersAction(Provider $id = null)
  {
    if ($id)
      $this->get('provider.service')->deleteProvider($id);

    return $this->render('@App/provider.html.twig', [
      'providers' => $this->get('provider.service')->getProviders()
    ]);
  }

  /**
   * @Route("/provider/new", name="newProvider")
   * @Method({"GET","POST"})
   */
  public function createProviderAction(Request $request)
  {
    $form = $this->createForm(ProviderType::class);
    $form->remove('active');
    $form->handleRequest($request);

    if ($form->isValid() && $form->isSubmitted()) {
      $this->get('provider.service')->createProvider($form->getData());
      return $this->redirectToRoute('provider');
    }

    return $this->render('@App/newProvider.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/provider/edit/{id}", name="providerEdit", defaults={"id":null})
   * @Method({"GET","POST"})
   */
  public function updateProviderAction(Request $request, Provider $id)
  {
    $form = $this->createForm(ProviderType::class, $id);
    $form->handleRequest($request);

    if ($form->isValid() && $form->isSubmitted()) {
      $this->get('provider.service')->updateProvider($form->getData());
      return $this->redirectToRoute('provider');
    }

    return $this->render('@App/editProvider.html.twig', [
      'form' => $form->createView()
    ]);
  }
}