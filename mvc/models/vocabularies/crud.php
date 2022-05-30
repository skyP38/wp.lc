<?php


  namespace \MVC\Models\Vocabularies;


  use \MVC\Models\Words\CRUD as Words;
  use \MVC\Models\DB\Connection as Connection;

  class CRUD
  {

    function __construct(private Words $words, private Connection $connection)
    {

    }

    public function create(string $name) : void
    {
      if($connection->default()->vocabularies->findOne(['name' => $name]) === NULL)
      {
        $id = ($connection->default()->vocabularies->findOne(['type' => 'count']))->count;
        $id++;

        $connection->default()->vocabularies->insertOne([
          'id' => $id,
          'name' => $name,
          'col' => sha1($id . $name)
        ]);

        $connection->default()->vocabularies->updateOne(
          ['type' => 'count'],
          ['$set' => ['count' => $id]]
        );
      }
    }

    public function read(string $name) : ?object
    {
      $voc = $connection->default()->vocabularies->findOne(['name' => $name]);
      if (!is_null($voc)) {
        $col = $voc->col;
        return $this->connection->default()->{$col}->find();
      }else {
        return (object) [];
      }
    }

    public function update(string $lastname, string $name) : void
    {
      $data = $connection->default()->vocabularies->findOne(['name' => $lastname]);
      $connection->default()->vocabularies->updateOne(
        ['id' => $data->{$id}],
        [
          '$set' => [
            'name' => $name,
            'col' => sha1($data->{$id}.$name)
          ]
        ]
      );
    }

    public function delete(string $name) : void
    {
      if($connection->default()->vocabularies->findOne(['name' => $name]) != NULL)
      {
        $connection->default()->vocabularies->deleteOne($name);
      }
    }

  }


?>
