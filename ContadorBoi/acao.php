
                
<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se foi enviado via GET para acao entra aqui CERTO
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;
        excluir($codigo);
    }

    // Se foi enviado via POST para acao entra aqui CERTO
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }


    // Métodos para cada operação
    function inserir($codigo){
        $dados = dadosForm();
        //var_dump($dados);

        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO marca (pesoKG, valorArroba, numeroBrinco, dataAbate, dataNasc, dataContagem) VALUES(:pesoKG, :valorArroba, :numeroBrinco, :dataAbate, :dataNasc, :dataContagem)');
        $stmt->bindParam(':pesoKG', $pesoKG, PDO::PARAM_INT);
        $pesoKG = $dados['pesoKG'];

        $stmt->bindParam(':valorArroba', $valorArroba, PDO::PARAM_INT);
        $valorArroba = $dados['valorArroba'];

        $stmt->bindParam(':numeroBrinco', $numeroBrinco, PDO::PARAM_INT);
        $numeroBrinco = $dados['numeroBrinco'];

        $stmt->bindParam(':dataAbate', $dataAbate, PDO::PARAM_STR);
        $dataAbate = $dados['dataAbate'];

        $stmt->bindParam(':dataNasc', $dataNasc, PDO::PARAM_STR);
        $dataNasc = $dados['dataNasc'];

        $stmt->bindParam(':dataContagem', $dataContagem, PDO::PARAM_STR);
        $dataContagem = $dados['dataContagem'];
    
        $stmt->execute();
        header("location:cad.php");
    }

    function editar($codigo){        
        $dados = dadosForm();
        $pdo = Conexao::getInstance();

        $stmt = $pdo->prepare('UPDATE marca SET dataContagem = :dataContagem, dataNasc = :dataNasc, dataAbate = :dataAbate, numeroBrinco = :numeroBrinco, valorArroba = :valorArroba, pesoKG = :pesoKG   WHERE codigo = :codigo');
        $stmt->bindParam(':dataContagem', $dataContagem, PDO::PARAM_STR);
        $stmt->bindParam(':dataNasc', $dataNasc, PDO::PARAM_STR);
        $stmt->bindParam(':dataAbate', $dataAbate, PDO::PARAM_STR);
        $stmt->bindParam(':numeroBrinco', $numeroBrinco, PDO::PARAM_INT);
        $stmt->bindParam(':valorArroba', $valorArroba, PDO::PARAM_INT);
        $stmt->bindParam(':pesoKG', $pesoKG, PDO::PARAM_INT);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $dataContagem = $dados['dataContagem'];
        $dataNasc = $dados['dataNasc'];
        $dataAbate = $dados['dataAbate'];
        $numeroBrinco = $dados['numeroBrinco'];
        $valorArroba = $dados['valorArroba'];
        $pesoKG = $dados['pesoKG'];
        $codigo = $dados['codigo'];
        $stmt->execute();
        header("location:index.php");
    }

    function excluir($codigo){ // certo
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from marca WHERE codigo = :codigo');
        $stmt->bindParam(':codigo', $codigoD, PDO::PARAM_INT);
        $codigoD = $codigo;
        $stmt->execute();
        header("location:index.php");

    }


    // Busca um item pelo código no BD CERTO
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM marca WHERE codigo = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['codigo'] = $linha['codigo'];
            $dados['dataContagem'] = $linha['dataContagem'];
            $dados['dataNasc'] = $linha['dataNasc'];
            $dados['dataAbate'] = $linha['dataAbate'];
            $dados['numeroBrinco'] = $linha['numeroBrinco'];
            $dados['valorArroba'] = $linha['valorArroba'];
            $dados['pesoKG'] = $linha['pesoKG'];
        }
        //var_dump($dados);
        return $dados;
    }

    // Busca as informações digitadas no form CERTO
    function dadosForm(){
        $dados = array();
        $dados['codigo'] = $_POST['codigo'];
        $dados['dataContagem'] = $_POST['dataContagem'];
        $dados['dataNasc'] = $_POST['dataNasc'];
        $dados['dataAbate'] = $_POST['dataAbate'];
        $dados['numeroBrinco'] = $_POST['numeroBrinco'];
        $dados['valorArroba'] = $_POST['valorArroba'];
        $dados['pesoKG'] = $_POST['pesoKG'];
        return $dados;
    }

?>