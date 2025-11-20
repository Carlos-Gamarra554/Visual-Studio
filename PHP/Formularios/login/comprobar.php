<?php
$arrayDatos=[
    "rosa"=>[
        "password"=>"1234",
        "name"=>"Rosa",
        "age" =>"40", 
    ],
    "ana"=>[
        "password"=>"1234",
        "name"=>"Ana",
        "age" =>"18", 
    ],
    "luis"=>[
        "password"=>"1234",
        "name"=>"Luis",
        "age" =>"49", 
    ],
    "antonio"=>[
        "password"=>"1234",
        "name"=>"Antonio",
        "age" =>"25", 
    ],
];
//recoger valores
$usuario= $_POST["usuario"];
$contra= $_POST["contra"];
// comprobar en la fuente de datos

if (isset ($arrayDatos[$usuario]) && ($contra== $arrayDatos[$usuario]["password"])  ){
        //echo "USUARIO Y CONTRA CORRECTOS";
        $name= $arrayDatos[$usuario]["name"];
        $edad= $arrayDatos[$usuario]["age"];
        header ("location:inicio.php?correcto=true&name={$name}&edad={$edad}");
        exit ();
}
else{
    $error_msg= "USUARIO O CONTRA INVALIDOS";
    
    header ("location:login.php?error_msg={$error_msg}&usuario={$usuario}");
    exit ();
}






//Si usu y contra correctos
// redireccionamos a inicio.php


//Si no, redireccionamos a login.php
//o al menos sacamos un mensaje