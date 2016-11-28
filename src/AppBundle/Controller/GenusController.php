<?php
/**
 * Created by PhpStorm.
 * User: dhuerta
 * Date: 27/11/16
 * Time: 00:56
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class GenusController extends Controller{

  /**
   * @Route("/genus/{genusName}")
   */
  public function showAction($genusName) {

    $notes = [
      'Octopus asked me',
      'I counted 8',
      'Inked!'
    ];

    return $this->render('genus/show.html.twig', [
        'name' => $genusName,
        'notes' => $notes
    ]);
  }

}