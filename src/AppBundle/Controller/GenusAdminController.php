<?php
/**
 * Created by PhpStorm.
 * User: huertix
 * Date: 12/12/16
 * Time: 10:42 PM
 */

namespace AppBundle\Controller;


use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Genus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\GenusFormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class GenusAdminController extends Controller
{
    /**
     * @Route("/genus", name="admin_genus_list")
     */
    public function indexAction()
    {
        $genuses = $this->getDoctrine()
            ->getRepository('AppBundle:Genus')
            ->findAll();
        return $this->render('admin/list.html.twig', array(
            'genuses' => $genuses
        ));
    }
    /**
     * @Route("/genus/new", name="admin_genus_new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(GenusFormType::class);

        // only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $genus = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($genus);
            $em->flush();

            $this->addFlash('success', 'Genus created!');
            return $this->redirectToRoute('admin_genus_list');
        }

        return $this->render('admin/new.html.twig', [
            'genusForm' => $form->createView()
        ]);
    }
  /**
   * Thanks to the param converter from SensioFrameworkExtraBundle,
   * this will automatically query for Genus by using the {id} value.
   * @Route("/genus/{id}/edit", name="admin_genus_edit")
   */
  public function editAction(Request $request, Genus $genus)
  {
    $form = $this->createForm(GenusFormType::class, $genus);

    // only handles data on POST
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $genus = $form->getData();

      $em = $this->getDoctrine()->getManager();
      $em->persist($genus);
      $em->flush();

      $this->addFlash('success', 'Genus updated!');
      return $this->redirectToRoute('admin_genus_list');
    }

    return $this->render('admin/edit.html.twig', [
      'genusForm' => $form->createView()
    ]);
  }
}