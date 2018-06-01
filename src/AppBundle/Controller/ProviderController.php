<?php
/**
 * Created by PhpStorm.
 * User: jordanbeziau
 * Date: 01/06/2018
 * Time: 10:50
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Provider;
use AppBundle\Entity\ProviderSupply;
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
   * @Route("/provider/new", name="newProvider", defaults={"id":null})
   * @Route("/provider/edit/{id}", name="providerEdit")
   * @Method({"GET","POST"})
   */
  public function createProviderAction(Request $request, Provider $id = null)
  {
    $providerService = $this->get('provider.service');
    $form = $this->createForm(ProviderType::class, $provider = $id ? $id : new Provider(), [
      'providerSupply' => $providerService->joinRequest($id)
    ]);
    if (!$id) $form->remove('active');
    $form->handleRequest($request);

    if ($form->isValid() && $form->isSubmitted()) {
      if (!$id)
        $this->get('provider.service')->createProvider($provider);
      else
        $this->get('provider.service')->updateProvider($provider);

      $formPost = $request->request->get('appbundle_provider');
      if (array_key_exists('providerSupply', $formPost) && !empty($formPost['providerSupply'])) {
        $formPost = $providerService->handleRelation($provider, $formPost);
        foreach ($formPost['providerSupply'] as $item) {
          $providerService->registerProviderSupply($item, $form->getData());
        }
      }
      return $this->redirectToRoute('provider');
    }

    return $this->render('@App/newProvider.html.twig', [
      'form' => $form->createView()
    ]);
  }
}