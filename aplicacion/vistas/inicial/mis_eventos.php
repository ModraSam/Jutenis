<?php 


echo CHTML::dibujaEtiqueta("div", ["class"=>"text-center", "style"=>"width:100%"]);
echo CHTML::modeloError($eventoUsuario, "cod_usuario", ["class"=>"alert alert-danger", "role"=>"alert", "style"=>"color: #721c24"]).PHP_EOL;

if (isset($errores)) {
    echo CHTML::dibujaEtiqueta("<div>",["class"=>"alert alert-danger"], $errores, true).PHP_EOL;
}


if (count($filas)==0){
    echo CHTML::dibujaEtiqueta("h1", ["style"=>"height: 50vh; margin-top: 20vh;"], "Actualmente no estas participando en ningun evento.", true);
}

foreach($filas as $fila)
{
    $this->dibujaVistaParcial("mis_eventos_evento",["fila"=>$fila,
                                             "usuario"=>$usuario,
                                            "eventoUsuario"=>$eventoUsuario
    ]);
}

echo CHTML::dibujaEtiquetaCierre("div");

