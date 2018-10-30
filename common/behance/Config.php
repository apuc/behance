<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 29.10.18
 * Time: 18:08
 */

namespace common\behance;


class Config
{
  public  static function get()
  {
      return [
        'apiKey'=>'H4Va0PDSnn8UhDxdqtkYNOkFJC8lbcYU',
        'proxyDriver' => 'common\behance\lib\UserAgentArray',
        'userAgentDriver' => 'common\behance\lib\UserAgentArray'
      ];
  }
}