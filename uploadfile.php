<?php
ob_start();
$arr= array();

$uploaddir = 'C:\OpenServer\domains\wp.lc\uploads';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if(in_array($_FILES['userfile']['type'], $arr)){
  echo('ok\n');
  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
      echo "Файл корректен и был успешно загружен.\n";
  } else {
      echo "fail\n";
  }
}
else{
  ob_clean();
  exit();
}


 ?>
