<?php

  namespace \MVC\Models\Search;
  use \MVC\Models\DB\Connection as Connection;


  class Search
  {
    private Connection $connection;

    function __construct(Connection $connection)
    {

    }

    
    public function __call(string $call_name, array $params) : ?object
    {
      $regex_val = "/^" . $params[0] . "/i";
      $result = $this->connection->{$call_name}->find([$params[0] => new \MongoDB\BSON\Regex($regex_val, 'i')]);

      return ($result != NULL) ? $result : NULL;
    }
  }

?>
