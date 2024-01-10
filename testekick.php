<?php
// Substitua esses valores pelos detalhes corretos do seu servidor de rádio
$server_ip = 'stream.truesecurity.com.br';
$server_port = '8044';
$server_password = '3W2JBYBF8TKYSSY';

// Verifique se a solicitação é um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extraia os dados da solicitação
    $data = file_get_contents("php://input");
    $event = json_decode($data, true);

    // Execute o comando kicksrc
    $scfp = fsockopen($server_ip, $server_port, $errno, $errstr, 10);
    if ($scfp) {
        fputs($scfp, "GET /admin.cgi?pass=".$server_password."&mode=kicksrc HTTP/1.0\r\nUser-Agent: SHOUTcast Song Status (Mozilla Compatible)\r\n\r\n");
        while (!feof($scfp)) {
            $page .= fgets($scfp, 1000);
        }
        fclose($scfp);
    }

    // Responda ao webhook
    echo json_encode(['success' => true]);
} else {
    // Se a solicitação não for um POST, retorne um erro
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido']);
}
?>
