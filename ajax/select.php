<?php
session_start();
$gmtDate = gmdate("D, d M Y H:i:s");
header("Expires: {$gmtDate} GMT");
header("Last-Modified: {$gmtDate} GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-Type: text/html; charset=ISO-8859-1");
include "db.php";

$base = "";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = 'SELECT * FROM `crud-isadora` where id = :id';
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
    $dados = $cmd->fetch();

    $base .= '
        <form action="" id="update" class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control"
                            placeholder="Digite o seu nome..." value="' . $dados['nome'] . '">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="form-label">Email</label>
                        <input type="hidden" name="id" id="id" class="form-control"
                            value="' . $dados['id'] . '">
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Digite o seu email..."value="' . $dados['email'] . '">
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col">
                        <label for="Estado" class="form-label">Estado</label>
                        <select name="estado" id="estado" class="form-control">
                            <option value="' . $dados['estado'] . '">' . $dados['estado'] . '</option>
                            <option value="Distrito Federal">Distrito Federal</option>
                            <option value="Goi�s">Goi�s</option>
                            <option value="Mato Grosso">Mato Grosso</option>
                            <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                            <option value="Alagoas">Alagoas</option>
                            <option value="Bahia">Bahia</option>
                            <option value="Cear�">Cear�</option>
                            <option value="Maranh�o">Maranh�o</option>
                            <option value="Para�ba">Para�ba</option>
                            <option value="Pernambuco">Pernambuco</option>
                            <option value="Piau�">Piau�</option>
                            <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                            <option value="Sergipe">Sergipe</option>
                            <option value="Acre">Acre</option>
                            <option value="Amap�">Amap�</option>
                            <option value="Amazonas">Amazonas</option>
                            <option value="Par�">Par�</option>
                            <option value="Rond�nia">Rond�nia</option>
                            <option value="Roraima">Roraima</option>
                            <option value="Tocantins">Tocantins</option>
                            <option value="Esp�rito Santo">Esp�rito Santo</option>
                            <option value="Minas Gerais">Minas Gerais</option>
                            <option value="Rio de Janeiro">Rio de Janeiro</option>
                            <option value="S�o Paulo">S�o Paulo</option>
                            <option value="Paran�">Paran�</option>
                            <option value="Santa Catarina">Santa Catarina</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="" class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="N�mero da identidade "value="' . $dados['cpf'] . '">
                        <!-- <input type="text"> input="text":Esta � a tag de entrada principal. O atributo type="text" especifica que � um campo para inserir
                        texto.
                        
                        name="cpf": O atributo name � usado para identificar o campo de dados quando os dados do formul�rio s�o enviados. Neste
                        caso, o nome do campo � "cpf", que pode indicar que � destinado � inser��o de um CPF (Cadastro de Pessoa F�sica, um
                        documento de identifica��o brasileiro).
                        
                        id="": O atributo id fornece um identificador �nico para o elemento HTML. Neste caso, est� vazio, o que n�o � ideal.
                        Normalmente, voc� colocaria um identificador aqui para referenciar o elemento com CSS ou JavaScript.
                        
                        class="form-control": O atributo class � usado para aplicar estilos CSS ao elemento. "form-control" � uma classe comum
                        em frameworks como Bootstrap, que estiliza o campo de entrada para se ajustar bem em formul�rios.
                        
                        placeholder="N�mero da identidade": O atributo placeholder fornece um texto de sugest�o ou orienta��o dentro do campo de
                        entrada antes que o usu�rio comece a digitar. Neste caso, sugere que o usu�rio insira o "N�mero da identidade". -->
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-4 offset-md-4">
                        <input type="submit" value="Atualizar" id="update" class="btn btn-success w-100">
                    </div>
                </div>
            </form>
    ';
}elseif(isset($_POST['deletar'])){
    //delete
    $id = $_POST['deletar'];
    $sql = 'DELETE from `crud-isadora` where id = :id';
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $dados = $cmd->execute();

    if ($cmd->rowCount() >= 1) {
        $base .= "<p class='alert alert-success text-center'>Deletado com sucesso!</p>";
    } else {
        $base .= "<p class='alert alert-danger text-center'> Falha na Remo��o!</p>";
    }


} else {
    $sql = 'SELECT * FROM `crud-isadora`';
    $cmd = $pdo->prepare($sql);
    $cmd->execute();
    $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);

    foreach ($dados as $x)
        $base .= '
    <tr>
        <td>' . $x['nome'] . '</td>
        <td>' . $x['email'] . '</td>
        <td>' . $x['estado'] . '</td>
        <td>' . $x['cpf'] . '</td>
        <td><input type="submit" value="Editar" class="btn
        btn-primary edit" id="' . $x['id'] . '"></td>
        <td><input type="submit" value="Deletar" class="btn
        btn-danger deletar" id="' . $x['id'] . '"></td>
    </tr>
';
    // // <!--<td>: Significa "table data cell" e � usado para definir uma c�lula padr�o em uma tabela, que cont�m dados. As c�lulas <td> s�o normalmente usadas dentro de <tbody> para representar os dados reais da tabela.-->
    // <!--<tr>: Significa "table row" e � usado para definir uma linha de c�lulas na tabela. Tanto as c�lulas de cabe�alho (<th>) quanto as c�lulas de tabela normais (<td>) s�o contidas dentro de uma <tr>.-->
}

echo $base;
