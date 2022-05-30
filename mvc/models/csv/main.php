<?php

namespace \MVC\Models\CSV;

/**
 *
 */
class Main
{

  use Encoder, Decoder;

  function __construct()
  {
    $this->separators = require_once DIR_MODELS . 'csv' . DSE .  'csvSeparators.php';
  }
}




 ?>
