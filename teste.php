<?php
// serialize your input array (say $array)
$serializedData = print_r($_POST,true);

// save serialized data in a text file
file_put_contents('teste.txt', $serializedData);
/*try {

    $conexao = mysqli_connect('nspro16.hostgator.com.br', 'calbus59_se6ry68', '!$Gd2*7AP&aP', 'calbus59_ctpuzzle_old');

    if (!$conexao) {
        die('Could not connect: ' . mysqli_error($conexao));
    }

    $sql = "INSERT INTO resultadosNovos ";
    $sql .= "(dataHora, aluno) ";
    $sql .= "VALUES ";
    $sql .= "('" . ($_POST['dataHora']) . "', '" . ($_POST['aluno']) . "')";

    $result = mysqli_query($conexao, $sql);
    if (mysqli_errno($conexao) > 0) {
        echo mysqli_error($conexao);
        die();
    }
    mysqli_close($conexao);
} catch (Exception $e) {
    echo 'Exceção capturada: ', $e->getMessage();
    die();
}*/

?>