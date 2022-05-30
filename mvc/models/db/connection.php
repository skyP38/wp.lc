<?php

namespace \MVC\Models\DB;

use \MVC\Models\Types\Collection as Collection;

class Connection
{
  private Collection $connection;

  // имя соединения
  private string $use = 'default';

  function __construct(string $ip = '127.0.0.1', string $port = '27017', string $target = 'test', bool|string $uname = false, string $pwd = '')
  {
    $this->connection = new Collection();
    $this->connection->{$this->use} = ($uname === false)
    ? (new \MongoDB\Client("mongodb://$ip:$port"))->{$target}
    : (new \MongoDB\Client("mongodb://$uname:$pwd@$ip:$port"))->{$target};
  }

// метод __call который создает новое соединение(string $id+параметры соединени)
// метод default который будет устанавливать свойство use  в состоянии default
// метод use который будет устанавливать имя соединения с которым мы сейчас работаем(string $a)=> $this->$a, return $this


  // $name имя коллекции
  public function __get(string $name)
  {
    return $this->connection->{$this->use}->{$name};
  }

  public function __call(string $id, ?object|array $params)
  {
    $this->connection->{$id} = (new \MongoDB\Client("mongodb://$params['uname']:$params['pwd']@$params['ip']:$params['port']")) -> {$params['target']}
  }

  public function default()
  {
    $this->use = 'default';
  }

  public function use(string $id) : self
  {
    $this->use = $id;
    return $this;
  }

}

 ?>
