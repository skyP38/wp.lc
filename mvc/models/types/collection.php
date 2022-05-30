<?php


final class Collection
{
  private object $data;

  function __construct(array|object $set = [])
  {
    $this->data = (object) [];
    foreach ($set as $id => $val) {
      $this->data->{$id} = (is_array($val) || $this->isObject($val))
      ? new static($val)
      : $val;
    }
  }


  public function __isset(string $id) : bool
  {
    return isset($this->data->{$id});
  }


  public function __set(string $id, mixed $val) : void
  {
    $this->data->{$id} = (is_array($val) || $this->isObject($val))
    ? new static($val)
    : $val;
  }


  public function __get(string $id) : mixed
  {
    return (isset($this->data->{$id}))
    ? $this->data->{$id}
    : NULL;
  }


  public function __call(string $id, ?array $params) : void
  {
    $this->data->{$id} = (!isset($this->data->{$id}))
    ? new static ($params);
    : (throw new \Exception("Id $id is already exist!", 1));
  }


  private function isObject(mixed $val) : bool
  {
    return is_object($val) && ( ($val instanceof \StdClass) || ($val instanceof \stdClass) || ($val instanceof \STDCLASS) );
  }


  public function foreach(callable $f) : void
  {
    foreach ($this->data as $key => $val)
    {
      $f($key, $val);
    }
  }
}


 ?>
