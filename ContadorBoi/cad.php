<!DOCTYPE html>
 <div class="row">
<?php
include_once "acao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : "";
    if ($codigo > 0)
        $dados = buscarDados($codigo);
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wcodigoth=device-wcodigoth, initial-scale=1.0">
    <title>Document</title>
    <script>
        function valcodigoa(){
            var numeroBrinco = document.getElementById("numeroBrinco");
            var valorArroba = document.getElementById("valorArroba");
            var pesoKG = document.getElementById("pesoKG");
            var dataNasc = document.getElementById("dataNasc");
            var dataContagem = document.getElementById("dataContagem");
            if (dataContagem.value == "") {
                dataContagem.focus();
                alert("Informe a data da contagem.");
                return false;
            }else if (dataNasc.value == "") {
                dataNasc.focus();
                alert("Informe a data do nascimento do animal.");
                return false;
            }else if (numeroBrinco.value == ""){
                numeroBrinco.focus();
                alert("Informe o número do brinco.");
                return false;
            } else if (pesoKG.value == ""){
                pesoKG.focus();
                alert("Informe o peso do animal.");
                return false;
            } else if (valorArroba.value == ""){
                valorArroba.focus();
                alert("Informe o valor da arroba.");
                return false;
            } 
            return true;        
        } 
    </script>

    <div class="container">
        <div class="row">
            <div class="col s6 offset-s4">
                <h2>Contador de Boi</h2>
            </div>
        </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<br>
<div class="row">
        <a href="index.php" class="btn waves-effect waves-light" type="submit" name="action">
            Listar <i class="material-icons right">reorder</i>
        </a>

    </div>
<br>

<form method="post" action="acao.php" >
    Código          <input readonly  type="text" name="codigo" id="codigo" value="<?php if ($acao == "editar") echo $dados['codigo']; else echo 0; ?>"><br>
    Data Contagem   <input  type="date" name="dataContagem" id="dataContagem" value="<?php if ($acao == "editar") echo $dados['dataContagem'] ?>"><br>
    Data Nascimento <input type="date" name="dataNasc" id="dataNasc" value="<?php if ($acao == "editar") echo $dados['dataNasc'] ?>"><br>
   Data Abate  <input  type="date" name="dataAbate" id="dataAbate" value="<?php if ($acao == "editar") echo $dados['dataAbate'] ?>"><br>
    Numero Brinco   <input type="number" name="numeroBrinco" id="numeroBrinco" value="<?php if ($acao == "editar") echo $dados['numeroBrinco']?>"><br>
    Peso KG         <input type="number" name="pesoKG" id="pesoKG" value="<?php if ($acao == "editar") echo $dados['pesoKG'] ?>"><br>
    Valor Arroba    <input type="number" name="valorArroba" id="valorArroba" value="<?php if ($acao == "editar") echo $dados['valorArroba'] ?>"><br>
    
    <button type="submit" name="acao" id="acao" value="salvar" class="btn waves-effect waves-light green"  name="action" onclick="return valcodigoa();">
            Salvar <i class="material-icons right">save</i>
    </button> 
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>
