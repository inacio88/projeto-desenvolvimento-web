# php


 php is a server-side scripting language

## variaveis em php

- começa com letra ou _
- não começa com número ou caracteres especiais

$nomeVariavel = 'frase';

echo $nomeVariavel;


## constantes em php

define('NOME', 'frase')
echo NAME;

não precisa do $ em constantes

## strings

$stringUm = 'meu email é';
$stringDois = 'carloe@gmail.com';

### concatenar string
echo $stringUm.$stringDois;
ou
echo $stringUm . $stringDois;

echo 'meu email é' . $stringDois;

### escaping caracters

echo "o tutor disse \" ola, bom dia \" ";
echo 'o tudo disse "ola, bom dia" ';

### indices na string

$nome = 'mario';

echo $nome[3]; retorna a letra nessa posição

### funções

echo strlen($nome);

echo strtoupper($nome);

echo stingtolower($nome);

echo str_replace('m', 'n', $nome);

### Operações básicas

- potência **
- o resto é padrão

### --------------------------------------

 $idade += 10;
 $idade -= 10;
 $idade *= 10;


### Funções numéricas

- truncar: echo floor(3.5)
- arredondar para cima: echo ceil(3.6);

## Vetores

### indexed arrays

 $pessoas = ["ana","alex","carla"];

 ou 

 $pessoas = array('ana', 'alex', 'carl');

Imprimir um array

    print_r($pessoas);

Add no final do array

 array_push($pesoas, 'pedro');

 tamanho do arry
 
 count($pessoas);

 Unir dois arrays

  $pessoasTres = array_merge($pessoas, $pessoasDois);

### associative arrays
#### usam chaves ao invés de index

 $pessoas = ['carlos'=>'22', 'mario'=>'11', 'pedro'=>'44'];

echo $pessoas['carlos'];

imprimir o array

print_r($pessoas);

add um novo valor:

 $pessoas['sara'] = '21';


### Multi-dimensional arrays   Vulgo matriz

 $blogs = [

     ['a1','a2','a3','a4'],

     ['b1','b2','b3','b4'],

     ['c1','c2','c3','c4']

 ];

 print_r($blogs);

 print_r($blogs[1][1]);


$blogs = [
 
     ['titulo'=>'a1','autor'=>'a2','conteudo'=>'a3','data'=>'a4'],
   
     ['titulo'=>'b1','autor'=>'b2',conteudo'=>'b3','data'=>'b4'],
   
     ['titulo'=>'c1','autor'=>'c2',conteudo'=>'c3','data'=>'c4']
 
 ];

  echo $blogs[2]['autor'];

    add um elemento

  $blogs[] = ['titulo'=>'d1','autor'=>'d2',conteudo'=>'d3','data'=>'d4'];

  #### remover do array
    vai remover o último elemento e retornar na função

   $elementoExcluido = array_pop($blogs);


### Loops

#### for
for ($i = 0; $i < 5; $i++){
  echo 'simple loop';
}

for ($i = 0; $i < count($blogs); $i++){
  echo 'simple loop';
}

foreach ($blogs as $blog){
  echo 'some template';
}

#### while
$i = 0;
while($i < count($products)){
  echo $products[$i]['name'];
  echo '<br />';
  $i++;
}

#### loop through html code

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Meu codigo php</title>
</head>
<body>
    <h1>
    <?php  foreach($products as $product){  ?>
    
      <h3> <?php  echo $product['name'];    ?> </h3>
      <h3> <?php  echo $product['price'];    ?> </h3>
    <? php  } ?>
  
</body>
</html>



### Boolean


#### Comparison boleans 

echo true; "1"

echo false; "" string vazia

echo 5 < 10; //true vai mostar 1

echo 5 == 10; //false string vazia

echo 'amelia' < 'bruno'; //true pq a letra 'a' vem antes de 'b'

echo 'amelia' > 'Amelia';// true pq tabela ascii

echo 'mario' == 'Mario';//false



#### loose vs strict equal comparison

- == não leva em consideração o tipo de dado
  - echo 5 == '5' // true
- === considera o tipo de dado
  - echo 5 === '5' // false


### Conditional statements

$price = 20;

if ($price < 30){
  echo 'true';
}
elseif ($price === 20){
  echo 'equal';
}

else {
  echo 'false';
}

#### break and continue

foreach($produtos as $produto){
  if ($produto['name'] === 'uva'){
    break;//sai do loop
  }

  if ($produto['price'] > 15){
    continue;//ele não executa o código abaixo e vai para o inícil do bloco foreach
  }

  echo $produto['name'] . '<br/>';
}


### Functions

function sayHello($name = 'ValorPadrao'){

  echo "Good morning, $name";

}

echo "{$produto['name']}"

sayHello(mario);




### Variable scop

#### local vars

function myFunc(){
  $price = 10;
  echo $price;
}



#### global

$name = 'mario';

function sayHello(){
  global $name;
  echo $name;
}

sayHello();


-------------------------
$name = 'mario';

// usa o & para passar por referência
function sayBye(&$name){
  $name = 'wario';
  echo 'by $name';
}

sayBye($name);

echo($name); //vai mostrar 'wario'



### include e require


- include incluir um arquivo
  - include('/caminho/arquivo.php');
- require se não for possível encontrar o arquivo requerido, o resto do código não funciona.
  - require('/caminho/arquivo.php');








