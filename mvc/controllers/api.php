<?php

  namespace MVC\Controllers;

  (defined('DSE') && defined('DIR_ROOT') && defined('DIR_MVC')) or exit('Access denied!');

  use \MVC\Models\Vocabularies\CRUD as Vocabularies;

  use \MVC\Models\Words\CRUD as Words;

  use \MVC\Models\CSV\Main as CSV;


  final class Api
  {

    function __construct(private Vocabularies $crud, private CSV $csv, private Words $words)
    {
      $this->csv = $csv;
      $this->words = $words;
      $this->get = explode('/', $_GET['route']);
      if (isset($this->get->{1})) {
        $method = match(true) {
          'get-vocabulary'      => 'getVocabulary',
          'set-vocabulary'      => 'setVocabulary',
          'get-all-vocabulary'  => 'getAllVocabularies',
          'get-vocabulary-name' => 'getVocabularyName',
        };
        $method();
      }else {
        exit('Invalid request!');
      }
    }

    private function getVocabulary() : void
    {
      if (isset($this->get->{2})) {
        $voc = $this->crud->read($this->get->{2});
        if (!is_null($voc)) {
          $result = (object) [];

          $i = 0;
          foreach ($voc as $doc) {
            $result->{$i} = (object) [];
            $result->{$i}->en = $doc->en;
            $result->{$i}->ru = $doc->ru;
            $i++;
          };
          header("Content-Type: application/json");
          echo json_encode($result);
          exit;
        }else {
          $id = $this->get->{2};
          exit('Vocabulary with id '$id' not found!');
        }
      }else {
        exit('Not found method argument!');
      }
    }


    private function getAllVocabularies() : void
    {

    }


    private function setVocabulary() : void
    {
      if(isset($this->get->{2})) {
        $data = $this->csv->import($this->get->{2});
        foreach ($data as $key => $val) {
          $this->words->create((array) $data->{$key});
        }
        $this->crud->create($this->get->{2});
      }
    }

    private function getVocabularyName($id) : ?string
    {
      $voc_name = $this->crud->read($this->get->{$id});
      return $voc_name;
    }

    // список олимпиад на год по проге
    // tilda js вставки
  }

?>
