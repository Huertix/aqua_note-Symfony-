<?php
/**
 * Created by PhpStorm.
 * User: dhuerta
 * Date: 11/12/16
 * Time: 22:38
 */

namespace AppBundle\Service;


class MarkDownTransformer {

  private $markdownParser;

  public function __construct($markdownParser)
  {
    $this->markdownParser = $markdownParser;
  }

  public function parse($str)
  {
    return $this->markdownParser
      ->transform($str);
  }

}