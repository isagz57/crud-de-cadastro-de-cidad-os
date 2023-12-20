<?php
$host = 'demandanet-dev.chgfc1bj8hfz.sa-east-1.rds.amazonaws.com'; // endere�o do seu servidor de banco de dados
$db   = 'teste'; // nome do seu banco de dados
$user = 'root'; // seu nome de usu�rio do banco de dados
$pass = 'WSaIcGpcimYZl9gINgbp'; // sua senha do banco de dados
$charset = 'latin1';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; //Cria uma string de conex�o (Data Source Name - DSN) que � usada pelo PDO para se conectar ao banco de dados. Ela inclui o tipo de banco de dados (mysql), o host, o nome do banco de dados e o conjunto de caracteres.
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,

    //$options = [...]: Define um array de op��es para a conex�o PDO. As op��es incluem:

    // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION: Configura o modo de erro para lan�ar exce��es. Isso ajuda a lidar com erros de uma maneira mais robusta.
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC: Define o modo padr�o de busca como associativo. Isso significa que os dados recuperados ser�o retornados como arrays associativos.
    // PDO::ATTR_EMULATE_PREPARES => false: Desabilita a emula��o de statements preparados, usando a prepara��o real do lado do banco de dados para maior seguran�a.
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

<!-- try {: Inicia um bloco try-catch. � usado para capturar e gerenciar exce��es (erros) que podem ocorrer durante a execu��o do c�digo dentro do bloco try.

$pdo = new PDO($dsn, $user, $pass, $options);: Tenta criar uma nova inst�ncia do objeto PDO, que representa uma conex�o com o banco de dados. Se bem-sucedido, $pdo ser� usado para opera��es futuras no banco de dados.

} catch (\PDOException $e) {: O bloco catch � executado se uma exce��o PDOException for lan�ada dentro do bloco try. Isso geralmente ocorre quando h� um problema ao se conectar ao banco de dados.

throw new \PDOException($e->getMessage(), (int)$e->getCode());: Lan�a novamente a exce��o capturada. Isso � �til para relatar ou lidar com o erro em outra parte do c�digo. -->