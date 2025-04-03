<?php
include 'conexion.php';
$document_type=$_POST ['document_type'];
$document_number=$_POST ['document_number'];
$name=$_POST ["name"];
$lastname=$_POST ["lastname"];
$email=$_POST ["email"];
$password=$_POST ["password"];

//echo $document_type." ".$document_number." ".$name." ".$lastname." ".$email." ".$password;

if (isset($document_type) && !empty($document_type) && isset($document_number) && !empty($document_number) && isset($name) && !empty($name) 
&& isset($lastname) && !empty($lastname) && isset($email) && !empty($email) && isset($password) && !empty($password)) {
    
    if($document_type==""){
        $resultado="Seleccione una opción válida";
        header('location:formulario_registro.php?var='.urlencode($resultado));
    }
    else if(!is_numeric($document_number)){
        $resultado="Digite solo números";
        header('location:formulario_registro.php?var='.urlencode($resultado));
    } 
    else if(!preg_match('/^[a-zA-Z]+$/',$name)){
        $resultado="Digite solo letras";
        header('location:formulario_registro.php?var='.urlencode($resultado));
    } 
    else if(!preg_match('/^[a-zA-Z]+$/',$lastname)){
        $resultado="Digite solo letras";
        header('location:formulario_registro.php?var='.urlencode($resultado));
    } 
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $resultado="Formato inválido";
        header('location:formulario_registro.php?var='.urlencode($resultado));
    }
    elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        $resultado = "La contraseña debe tener al menos 8 caracteres, una letra minúscula, una letra mayúscula, un número y un carácter especial.";
        header('location:formulario_registro.php?var=' . urlencode($resultado));
    }

    // Verificar si el número de documento ya existe
    $sql_check = "SELECT * FROM register WHERE document_number = ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bind_param("i", $document_number);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // El número de documento ya existe
        $resultado = "El número de documento ya está registrado.";
        header('location: formulario_registro.php?var=' . urlencode($resultado));
        exit();
    } else {

        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql="INSERT INTO register(document_type, document_number, name, lastname, email, password) 
        VALUES ('$document_type', '$document_number', '$name', '$lastname', '$email', '$password_hashed')";
        
        if (mysqli_query($conexion, $sql)) {
            $resultado = "Registro exitoso";
        } else {
            $resultado = "Error al registrar".mysqli_error($conexion);
        }

        header('location: formulario_registro.php?var=' . urlencode($resultado));
        exit();
        
    }
    
} else {
    $resultado="Todos los campos son obligatorios.";
    header('location:formulario_registro.php?var='.urlencode($resultado));
    exit();
}


?>