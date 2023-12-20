<?php
session_start();
$gmtDate = gmdate("D, d M Y H:i:s");
header("Expires: {$gmtDate} GMT");
header("Last-Modified: {$gmtDate} GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-Type: text/html; charset=ISO-8859-1");

include "db.php";
$erro = array();
$saida = "";

if (isset($_POST['id'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $estado = addslashes($_POST['estado']);
    $cpf = addslashes($_POST['cpf']);
    $id = $_POST['id'];

    $sql = 'UPDATE `crud-isadora` SET nome = :n, email = :e, estado = :st, cpf = :c WHERE id = :id';
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":n", $nome);
    $cmd->bindValue(":e", $email);
    $cmd->bindValue(":st", $estado);
    $cmd->bindValue(":c", $cpf);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
    if ($cmd->rowCount() >= 1) {
        $saida .= "<p class='alert alert-success text-center'>Cidadão(a) "  . $nome . " atualizado com sucesso!</p>";
    } else {
        $saida .= "<p class='alert alert-danger text-center'> Falha na atualização!</p>";
    }
} else {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $estado = utf8_decode($_POST['estado']);
    var_dump($estado);
    $cpf = addslashes($_POST['cpf']);

    if (empty($nome)) {
        $erro['e'] = "Digite o nome!";
    } elseif (empty($email)) {
        $erro['e'] = "Digite o email!";
    } elseif (empty($estado)) {
        $erro['e'] = "Selecione o estado!";
    } elseif (empty($cpf)) {
        $erro['e'] = "Digite o CPF!";
    } else {
        $sql = 'INSERT INTO `crud-isadora` (nome, email, estado, cpf) values(:n, :e, :st, :c)';
        $cmd = $pdo->prepare($sql);
        $cmd->bindValue(":n", $nome);
        $cmd->bindValue(":e", $email);
        $cmd->bindValue(":st", $estado);
        $cmd->bindValue(":c", $cpf);
        $cmd->execute();
        if ($cmd->rowCount() >= 1) {
            $saida = "<p class='alert alert-success text-center'>Cidadão(a) "  . $nome . " cadastrado com sucesso!</p>";
        } else {
            $saida = "<p class='alert alert-danger text-center'>Falha no Cadastro!</p>";
        }
    }
}

if (isset($erro['e'])) {
    $saida = "<p class='alert alert-danger text-center'>" . $erro['e'] . "</p>";
}


echo $saida;
