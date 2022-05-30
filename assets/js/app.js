$(document).ready(function () {

  let data = getVocabulary();
  let add = getVocName();
  let len = data['ru'].length;
  let q = 0;
  let fl = true;

  $("button#show").click(function(){
    $("h4#word").html(data[(fl) ? 'ru' : 'en'][q]);
    q++;
  });

  $('button#next').click(function(){
    q++;
    $('h3#title').html(data[(fl) ? 'en' : 'ru'][q]);
  });



  $('a#lang').click(function(e){
    (fl)
    ? $('a#lang').text('RU->EN')
    : $('a#lang').text('EN->RU');
    fl=!fl;
  });

  $('button#addBtn').click(function(){

  });

});

function off() {
}

async function getVocabulary(id){
  let response = await fetch(`/api/get-vocabulary/${id}`, {
    method: 'GET',
  });
  let result = await response.json();
  let ru = [];
  let en = [];
  for (var id in result) {
    ru[id] = result['ru'];
    en[id] = result['en'];
  }
  return {'ru' : ru,'en' : en};
};


async function getVocName(id) {
  let response = await fetch(`/api/get-vocabulary-name/${id}`, {
    method: 'GET',
  });
  let result = await response.json();
  $('span#voca_name').html(result['name']);
}
