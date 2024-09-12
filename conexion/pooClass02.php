<?php

// Abstraccion:

// 1 - Se crea la clase
class Usuario{
    // Determino los atributos.
    private $nombresCompletos;
    private $correo;
    private $password;
    protected $fechaRegistro;
    static $valorEstado="Registrados";

    // 2 - Creo el Metodo Constructor.
    function __construct($nombre, $email){
        // 3 - Determina la asignacion de variables.
        $this->nombresCompletos =$nombre;
        $this->correo =$email;
        $this->password=rand(); // Asigna clave en forma aleatoria.
        $this->fechaRegistro =date("Y-m-d H:m:s"); // Visualiza el Formato de fecha y hora
    }

    // 4 - Se crea el metodo publico
    public function verPerfil(){
        echo "Ver Datos del Uusuario <br>";
        echo "Nombre del Usuario:" .$this->nombresCompletos.'<br>';
        echo 
        "Correo Electronico:" .$this->correo.'<br>';
        echo "Clave Usuario:" .$this->password.'<br>';
        echo "Fecha de Registro:" .$this->fechaRegistro.'<br>';
        echo "Estado del Usuario:" .self::$valorEstado.'<br>'; // acceder a una variable estatica
    }

    public function modificarClave(string $nuevaClave){
        $this->password=$nuevaClave;
    }
}

   // Se realiza la instacia u Objeto.
   $usuario1 = new Usuario('DorismelPerez','dperez@gmail.com');
   $usuario2 = new Usuario('juanaDeArco','darco@hotmail.com');

   // Visualizamos los datos del perfil de usuario.
   echo $usuario1->verPerfil();
   echo "<br><br>";
   echo $usuario2->verPerfil();
   $usuario2->modificarClave("12358");
   echo "<br><br>";
   echo $usuario2->verPerfil();
?>