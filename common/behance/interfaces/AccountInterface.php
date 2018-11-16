<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 01.11.18
 * Time: 15:08
 */

namespace common\behance\interfaces;


interface AccountInterface
{
  public function getWorks();
  public function likeWork($workBehanceId,$proxy,$userAgent);
  public function viewWork($workBehanceId,$proxy,$userAgent);
}