<?php

  define('DSE', DIRECTORY_SEPARATOR);
  define('DIR_ROOT', dirname(__FILE__) . DSE);
  define('DIR_API', DIR_ROOT . 'api' . DSE);
  define('DIR_MVC', DIR_ROOT . 'mvc' . DSE);
  define('DIR_MODELS', DIR_MVC . 'models' . DSE);
  define('DIR_VIEWS', DIR_MVC . 'views' . DSE);
  define('DIR_CONTROLLERS', DIR_MVC . 'controllers' . DSE);

  require_once DIR_MODELS . 'db' . DSE . "vendor" . DSE . 'autoload.php';
  require_once DIR_CONTROLLERS . 'router.php';


  require_once DIR_VIEWS . 'default' . DSE . 'head.php';
  require_once DIR_VIEWS . 'default' . DSE . 'nav.php';
  require_once DIR_VIEWS . 'home.php';
  require_once DIR_VIEWS . 'default' . DSE . 'footer.php';

/*
* подключить composer в db
* toogle jquery
*
* пример реестра словари + пример реестра слов
* посмотреть роутинг на symphony чтобы читался с yaml
* подключить gulp+jquery
*
*/
?>
