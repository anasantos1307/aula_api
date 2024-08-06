<?php
    header('Content-Type: application/json');
    include 'conexao.php';

    $metodo = $_SERVER['REQUEST_METHOD'];

    //echo json_encode($metodo);

    $url = $_SERVER['REQUEST_URI'];

    $path = parse_url($url, PHP_URL_PATH);
    $path = trim($path, '/');

    $path_parts = explode('/',$path);

    $primeiraparte = isset($path_parts[0]) ? $path_parts[0] : '';
    $segundaparte = isset($path_parts[1]) ? $path_parts[1] : '';
    $terceiraparte = isset($path_parts[2]) ? $path_parts[2] : '';
    $quartaparte = isset($path_parts[3]) ? $path_parts[3] : '';

    $resposta = [
        'metodo' => $metodo,
        'primeiraparte' => $primeiraparte,
        'segundaparte' => $segundaparte,
        'terceiraparte' => $terceiraparte,
        'quartaparte' => $quartaparte,
    ];

    //echo json_encode($resposta);

    switch($metodo){
        case 'GET':
            if ($terceiraparte == 'alunos' && $quartaparte == ''){
                lista_alunos();
            }
            elseif($terceiraparte == 'alunos' && $quartaparte != ''){
                lista_um_aluno($quartaparte);
            }
            elseif($terceiraparte == 'cursos' && $quartaparte == ''){
                lista_cursos();
            }
            elseif($terceiraparte == 'cursos' && $quartaparte != ''){
                lista_um_curso($quartaparte);
            }
            break;
        case 'POST':
            if ($terceiraparte == 'alunos'){
                echo json_encode([
                    'mensagem' => 'INSERE UM ALUNO NOVO'
                ]);
            }
            elseif ($terceiraparte == 'cursos'){
                echo json_encode([
                    'mensagem' => 'INSERE UM CURSO NOVO'
                ]);
            }
            break;
        case 'PUT':
            break;
        case 'DELETE':
            break;
        default:
        echo json_encode([
            'mensagem' => 'Método não permitido!'
        ]);
        break;
    }
    //LISTA DE ALUNOS
    function lista_alunos(){
        global $conexao;
        $resultado = $conexao->query("SELECT * FROM alunos");
        $alunos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode([
            'mensagem' => 'LISTA DE TODOS OS ALUNOS',
            'dados' => $alunos
        ]);
    }

    function lista_um_aluno($quartaparte){
        global $conexao;
        $stmt = $conexao->prepare("SELECT * FROM alunos WHERE id = ?");
        $stmt->bind_param('i',$quartaparte);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $aluno = $resultado->fetch_assoc();
        echo json_encode([
            'mensagem' => 'LISTA DE UM ALUNO',
            'dados_aluno' => $aluno
        ]);
    }

    //LISTA DOS CURSOS
    function lista_cursos(){
        global $conexao;
        $resultado = $conexao->query("SELECT * FROM cursos");
        $cursos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode([
            'mensagem' => 'LISTA DE TODOS OS CURSOS',
            'dados' => $cursos
        ]);
    }

    function lista_um_curso($quartaparte){
        global $conexao;
        $stmt = $conexao->prepare("SELECT * FROM cursos WHERE id_curso = ?");
        $stmt->bind_param('i',$quartaparte);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $curso = $resultado->fetch_assoc();
        echo json_encode([
            'mensagem' => 'LISTA DE UM CURSO',
            'dados_curso' => $curso
        ]);
    }

?>