 <?php


  namespace \MVC\Models\Words;


  use \MVC\Models\DB\Connection as Connection;


  class CRUD
  {
    // id коллекции слов.
    private string $use;
    private array $en;

    function __construct(private Connection $connection)
    {
      $this->en = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
      'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    }


    // id словаря
    public function use(string $id) : self
    {
      $v = $this->connection->default()->vocabularies->findOne(['id' => $id]);
      $this->use = $v->col;
    }


    public function create(array $words)
    {
      $data = ['en' => $words[0], 'ru' => $words[1]];
      if($connection->default()->{$this->use}->findOne(['en' => $words[0], 'ru' => $words[1]]) === NULL)
      {
        $connection->default()->{$this->use}->insertOne($data);
      }
    }

    public function read(string $word)
    {
      (in_array($word[0], $this->en))
      ? $connection->default()->{$this->use}->findOne(['en' => $word])
      : $connection->default()->{$this->use}->findOne(['ru' => $word])
    }


    // public function update(string $word)
    // {
    //   $data = $connection->default()->{$this->use}->findOne(['word' =>$word]);
    //   // СДЕЛАТЬ ПРОВЕРКУ СЛОВА!
    //   $connection->default()->{$this->use}->updateOne(
    //     ['id' => $data->{$id}],
    //     ['$set' => ['word' => $word]]
    //   );
    // }


    public function delete(array $words) //объектом загрузить данные
    {
      $data = findOne(['en' => $words[0], 'ru' = $words[1]]);

      if($connection->default()->{$this->use}->find('id' => $data->{$wordId}))
      {
        $connection->default()->{$this->use}->deleteOne($data);
      }
    }
  }

?>
