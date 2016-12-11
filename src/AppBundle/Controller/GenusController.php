<?php
/**
 * Created by PhpStorm.
 * User: dhuerta
 * Date: 27/11/16
 * Time: 00:56
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Genus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class GenusController extends Controller{

  /**
   * @Route("/genus")
   */
  public function listAction()
  {
    $em = $this->getDoctrine()->getManager();
    $genuses = $em->getRepository('AppBundle\Entity\Genus')
      ->findAll();
    //dump($genuses);die;

    return $this->render('genus/list.html.twig', [
      'genuses' => $genuses
    ]);

  }

  /**
   * @Route("/genus/new", name="")
   */
  public function newAction() {
      $genus = new Genus();
      $genus->setName('Octopus'.rand(1, 100));
      $genus->setSubFamily('Octopodinae');
      $genus->setSpeciesCount(rand(100, 99999));

      $em = $this->getDoctrine()->getManager();
      $em->persist($genus);
      $em->flush();

      return new Response('<html><body><h1>created '.$genus->getName().'</h1></body></html>');
  }



  /**
   * @Route("/genus/{genusName}", name="genus_show")
   */
  public function showAction($genusName) {

    $em = $this->getDoctrine()->getManager();
    $genus = $em->getRepository('AppBundle:Genus')
      ->findOneBy(['name' => $genusName]);

    if (!$genus) {
      throw $this->createNotFoundException('genus not found');
    }

    //$notes = [
    //  'Octopus asked me',
    //  'I counted 8',
    //  'Inked!'
    //];
    //
    //$funFact = 'Octopuses can change the color of their body in just *three-tenths* of a second!';
    //
    //$cache = $this->get('doctrine_cache.providers.my_markdown_cache');
    //$key = md5($funFact);
    //
    //if ($cache->contains($key)) {
    //
    //  $funFact = $cache->fetch($key);
    //} else {
    //
    //  sleep(1); // fake how slow this could be
    //  $funFact = $this->get('markdown.parser')
    //    ->transform($funFact);
    //
    //  $cache->save($key, $funFact);
    //  print 'no';
    //}

    //return $this->render('genus/show.html.twig', [
    //  'name' => $genusName,
    //  'notes' => $notes,
    //  'funFact' => $funFact,
    //]);

    return $this->render('genus/show.html.twig', [
        'genus' => $genus,
    ]);
  }

  /**
   * @Route("/genus/{genusName}/notes", name="genus_show_notes")
   * @Method("GET")
   */
  public function getNotesAction() {

    $notes = [
      ['id' => 1,
       'username' => 'AquaPelham',
       'avatarUri' => '/images/leanna.jpeg',
       'note' => 'Octopus asked me',
       'date' => 'Dec. 10, 20016'],
      ['id' => 2,
       'username' => 'AquaPelham',
       'avatarUri' => '/images/ryan.jpeg',
       'note' => 'I counted 8',
       'date' => 'Dec. 11, 20016'],
      ['id' => 3,
       'username' => 'AquaPelham',
       'avatarUri' => '/images/leanna.jpeg',
       'note' => 'Inked!',
       'date' => 'Dec. 12, 20016'],

    ];

    $data = [
      'notes' => $notes
    ];

    return new JsonResponse($data);
    //return new Response(json_encode($data));

  }
}