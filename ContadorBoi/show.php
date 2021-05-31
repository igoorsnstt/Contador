<!DOCTYPE html>
<?php 
     include_once "conf/default.inc.php";
     require_once "conf/Conexao.php";
     $title = "Lista de Clientes";
     $id = isset($_GET['id']) ? $_GET['id'] : "1";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
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
    <a href="cad.php?acao=editar&codigo=<?php echo $id;?>" class="btn waves-effect waves-light grey darken-1" type="submit" name="action">
            Alterar <i class="material-icons right">visibility</i>
    </a>
    <a href="index.php" class="btn waves-effect waves-light" type="submit" name="action">
            Listar <i class="material-icons right">reorder</i>
    </a>
    <a href="cad.php" class="btn waves-effect waves-light green" type="submit" name="action">
            Inserir Novo Boi <i class="material-icons right">add</i>
    </a>
<br>

<?php
   
    $sql = "SELECT * FROM marca WHERE codigo = $id";
   
    $pdo = Conexao::getInstance(); 
    $consulta = $pdo->query($sql);
    while ($linha = $consulta->fetch(PDO::FETCH_BOTH)){
        echo "<br>Código: {$linha['codigo']} <br> Data Contagem: {$linha['dataContagem']} <br>  Data Nasc: {$linha['dataNasc']} <br>  Data Abate: {$linha['dataAbate']} <br>  Numero do Brinco: {$linha['numeroBrinco']} <br>  PesoKG: {$linha['pesoKG']} <br>  Valor da Arroba: R$ {$linha['valorArroba']} <br/>";
    }
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>