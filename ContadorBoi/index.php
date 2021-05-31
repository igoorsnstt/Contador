<!DOCTYPE html>
<?php $hoje = date('d/m/Y');?>

<?php 
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    $title = "Lista de Marcas";
    
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "2";
    $consulta = isset($_POST['consulta']) ? $_POST['consulta'] : "";

?>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <div class="container">
        <div class="row">
            <div class="col s6 offset-s4">
                <h2>Contador de Boi</h2>
            </div>
        </div>
    <title> <?php echo $title; ?> </title >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function excluirRegistro(url){
            if (confirm("Deseja realmente excluir?"))
                location.href = url; 
        }
    </script>
</head>
<body>
    <div class="col s12">
                <h6>Ordernar por:</h6>
            </div>
        
        <form method="post">
            <div class="row">
                <p>
                    <label>
                        <input type="radio" name="tipo" value="1" <?php if ($tipo == 1) { echo "checked"; }?>>
                        <span>Código</span>
                    </label>
                </p>

                <p>
                    <label>
                        <input type="radio" name="tipo" value="2" <?php if ($tipo == 2) { echo "checked"; }?>>
                        <span>Número do Brinco</span>
                    </label>
                </p>
            </div>
    <br>
    
    
    
        <a href="cad.php" class="btn waves-effect waves-light green" type="submit" name="action">
            Inserir novo boi <i class="material-icons right">add</i>
        </a>
        <a href="index.php" class="btn waves-effect waves-light" type="submit" name="action">
            Listar <i class="material-icons right">reorder</i>
        </a>
    
    <br><br>
    <form method="post">
    <input type="text" name="consulta" id="consulta" value="">
    <button type="submit" value=Pesquisar class="btn waves-effect waves-light green " type="submit" name="action">
            Pesquisar <i class="material-icons right">search</i>
        </button>
    </form>
  
    <br><br>

    <table border="1">
        <tr>
        <th>Código</th>
        <th>Data Contagem</th>
        <th>Data Nascimento</th>
        <th>Data Abate</th>
        <!-- <th>Idade</th> -->
        <th>Numero Brinco</th>
        <th>Peso KG</th>
        <th>Valor Arroba</th>
        <th>Valor Total</th>
        <th>Dias para o Abate</th> 
        <th>Detalhes</th> 
        <th>Alterar</th> 
        <th>Excluir</th> 
    </tr>

    <?php
    $sql = "";
        if ($tipo == 1){
            if ($consulta != '') {
            $sql = "SELECT * FROM marca WHERE codigo = '$consulta' ORDER BY codigo";
                } else {
            $sql = "SELECT * FROM marca ORDER BY codigo";
            }
            } else{    
            $sql = "SELECT * FROM marca WHERE numeroBrinco LIKE '$consulta%' ORDER BY numeroBrinco";
            } 
    $pdo = Conexao::getInstance();
    $consulta = $pdo->query($sql);
    
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        $valorTotal = floor(($linha['pesoKG'] / 15) * $linha['valorArroba']);
        // Primeiro campo calculado

        $diasAbate = strtotime($linha['dataAbate']) - strtotime($linha['dataNasc']);
        $dias = floor($diasAbate / (60 * 60 * 24));
        //Segundo campo calculado, transforma a data prevista para o abate em dias

        //$idad = strtotime($linha['dataNasc']) - strtotime($hoje);
        //$Idade = floor($idad / (60 * 60 * 24 * 365));
        // Tentei calcular a idade do animal em anos mas não consegui

        ?>
        <tr>
            <td><?php echo $linha['codigo'];?></td>
            <td><?php echo date("d/m/Y", strtotime($linha['dataContagem']));?></td>
            <td><?php echo date("d/m/Y", strtotime($linha['dataNasc']));?></td>
            <td><?php echo date("d/m/Y", strtotime($linha['dataAbate']));?></td>
            <!-- <?php //echo "<td>{$Idade}</td>";?> -->
            <td><?php echo $linha['numeroBrinco'];?></td>
            <td><?php echo $linha['pesoKG'];?></td>
            <?php echo "<td> R$ {$linha['valorArroba']}</td>";?>
            <?php echo "<td> R$ {$valorTotal}</td>";?>
            <?php echo "<td>{$dias}</td>";?>
            <td><a href='show.php?id=<?php echo $linha['codigo'];?>'> <img class="icon" src="img/show.png" alt=""> </a></td>
            <td><a href='cad.php?acao=editar&codigo=<?php echo $linha['codigo'];?>'><img class="icon" src="img/edit.png" alt=""></a></td>
            <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&codigo=<?php echo $linha['codigo'];?>')"><img class="icon" src="img/delete.png" alt=""></a></td>
        </tr>
   <?php } ?>
      
    </table>
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
