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
                            <option value="Goiás">Goiás</option>
                            <option value="Mato Grosso">Mato Grosso</option>
                            <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                            <option value="Alagoas">Alagoas</option>
                            <option value="Bahia">Bahia</option>
                            <option value="Ceará">Ceará</option>
                            <option value="Maranhão">Maranhão</option>
                            <option value="Paraíba">Paraíba</option>
                            <option value="Pernambuco">Pernambuco</option>
                            <option value="Piauí">Piauí</option>
                            <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                            <option value="Sergipe">Sergipe</option>
                            <option value="Acre">Acre</option>
                            <option value="Amapá">Amapá</option>
                            <option value="Amazonas">Amazonas</option>
                            <option value="Pará">Pará</option>
                            <option value="Rondônia">Rondônia</option>
                            <option value="Roraima">Roraima</option>
                            <option value="Tocantins">Tocantins</option>
                            <option value="Espírito Santo">Espírito Santo</option>
                            <option value="Minas Gerais">Minas Gerais</option>
                            <option value="Rio de Janeiro">Rio de Janeiro</option>
                            <option value="São Paulo">São Paulo</option>
                            <option value="Paraná">Paraná</option>
                            <option value="Santa Catarina">Santa Catarina</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="" class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Número da identidade "value="' . $dados['cpf'] . '">
                        <!-- <input type="text"> input="text":Esta é a tag de entrada principal. O atributo type="text" especifica que é um campo para inserir
                        texto.
                        
                        name="cpf": O atributo name é usado para identificar o campo de dados quando os dados do formulário são enviados. Neste
                        caso, o nome do campo é "cpf", que pode indicar que é destinado à inserção de um CPF (Cadastro de Pessoa Física, um
                        documento de identificação brasileiro).
                        
                        id="": O atributo id fornece um identificador único para o elemento HTML. Neste caso, está vazio, o que não é ideal.
                        Normalmente, você colocaria um identificador aqui para referenciar o elemento com CSS ou JavaScript.
                        
                        class="form-control": O atributo class é usado para aplicar estilos CSS ao elemento. "form-control" é uma classe comum
                        em frameworks como Bootstrap, que estiliza o campo de entrada para se ajustar bem em formulários.
                        
                        placeholder="Número da identidade": O atributo placeholder fornece um texto de sugestão ou orientação dentro do campo de
                        entrada antes que o usuário comece a digitar. Neste caso, sugere que o usuário insira o "Número da identidade". -->
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
        $base .= "<p class='alert alert-danger text-center'> Falha na Remoção!</p>";
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
    // // <!--<td>: Significa "table data cell" e é usado para definir uma célula padrão em uma tabela, que contém dados. As células <td> são normalmente usadas dentro de <tbody> para representar os dados reais da tabela.-->
    // <!--<tr>: Significa "table row" e é usado para definir uma linha de células na tabela. Tanto as células de cabeçalho (<th>) quanto as células de tabela normais (<td>) são contidas dentro de uma <tr>.-->
}

echo $base;
