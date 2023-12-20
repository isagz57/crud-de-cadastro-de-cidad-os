<?php
$host = 'demandanet-dev.chgfc1bj8hfz.sa-east-1.rds.amazonaws.com'; // endereço do seu servidor de banco de dados
$db   = 'teste'; // nome do seu banco de dados
$user = 'root'; // seu nome de usuário do banco de dados
$pass = 'WSaIcGpcimYZl9gINgbp'; // sua senha do banco de dados
$charset = 'latin1';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset"; //Cria uma string de conexão (Data Source Name - DSN) que é usada pelo PDO para se conectar ao banco de dados. Ela inclui o tipo de banco de dados (mysql), o host, o nome do banco de dados e o conjunto de caracteres.
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,

    //$options = [...]: Define um array de opções para a conexão PDO. As opções incluem:

    // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION: Configura o modo de erro para lançar exceções. Isso ajuda a lidar com erros de uma maneira mais robusta.
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC: Define o modo padrão de busca como associativo. Isso significa que os dados recuperados serão retornados como arrays associativos.
    // PDO::ATTR_EMULATE_PREPARES => false: Desabilita a emulação de statements preparados, usando a preparação real do lado do banco de dados para maior segurança.
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

<!-- try {: Inicia um bloco try-catch. É usado para capturar e gerenciar exceções (erros) que podem ocorrer durante a execução do código dentro do bloco try.

$pdo = new PDO($dsn, $user, $pass, $options);: Tenta criar uma nova instância do objeto PDO, que representa uma conexão com o banco de dados. Se bem-sucedido, $pdo será usado para operações futuras no banco de dados.

} catch (\PDOException $e) {: O bloco catch é executado se uma exceção PDOException for lançada dentro do bloco try. Isso geralmente ocorre quando há um problema ao se conectar ao banco de dados.

throw new \PDOException($e->getMessage(), (int)$e->getCode());: Lança novamente a exceção capturada. Isso é útil para relatar ou lidar com o erro em outra parte do código. -->