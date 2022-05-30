<?php

namespace \MVC\Models\CSV;
/**
 * кодирование через метод foreach коллекции
 */
trait Encoder
{
  //универсальный разделитель
  private const SEPARATOR = ';';


  public function encoder(array|object $data)
  {
    $result = '';
    foreach ($data as $val) {
      $result .= ((is_object($val) && ($val instanceof \StdClass)) || is_array($val))
      ? $this->encoder($val) . PHP_EOL
      : $val . self::SEPARATOR;
    }
    return $result;
  }


}




 ?>
