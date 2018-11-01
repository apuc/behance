<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 01.11.18
 * Time: 15:09
 */

namespace common\behance\interfaces;


interface WorkInterface
{
  public function like($count=1);
  public function view($count=1);
}