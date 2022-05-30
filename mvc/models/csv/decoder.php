<?php

namespace \MVC\Models\CSV;

trait Decoder
{
  private object $separators;


  public function import(string $path) : object
  {
    $file = fopen($path, 'r');
    $data = (filesize($path) > 0)
    ? fread($file, filesize($path))
    : '';
    fclose($file);

    return $this->decoder($data);
  }

  public function decoder(string $str) : object
  {
    $sep = '';
    $len = strlen($str);
    for ($i=0; $i < $len-1; $i++) {
      if(!is_int($str[$i]) && !is_int($str[$i+1])){
        $sep = $str[$i];
        break;
      }
    }
    if (!in_array($sep, (array) $this->separators)) {
      throw new \Exception("Unknow separator $sep!", 1);
    }

    $rows = explode(PHP_EOL, $str);
    $result = (object) [];
    foreach ($rows as $id => $row) {
      $result->{$id} = (object) explode($sep, $row);
    }
    return $result;
  }

}



 ?>
