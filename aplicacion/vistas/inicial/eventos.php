<?php 

$this->textoHead.=PHP_EOL.CPager::requisitos();


$pagi=new CPager($opcPag,array());


//dibujo el paginador
//echo $pagi->dibujate();

$usuario = new Vista_usuarios();

if(Sistema::app()->Acceso()->hayUsuario()){
    $usuario = $usuario::getUsuario();
    
    $usuario = $usuario[0]["cod_usuario_usu"];
}

//formulario filtrado-------------------------

echo CHTML::dibujaEtiqueta("div",["class"=>"text-left col-md-3"], "", false).PHP_EOL;

echo CHTML::iniciarForm("","get",["id"=>"filtrado"]);

echo CHTML::dibujaEtiqueta("div", ["id"=>"display-opcion-filtrado" ]);


    echo CHTML::dibujaEtiqueta("div", ["class"=>"row"] );

        echo CHTML::campoLabel("Población:", "poblacion").
        CHTML::campoListaDropDown("poblacion",$dat["poblacion"],
            Eventos::listaPoblaciones(),
            ["linea"=>"Sin seleccionar", "form"=>"filtrado", "class"=>"form-control", "style"=>"width:100%"]).PHP_EOL;
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
    echo CHTML::dibujaEtiqueta("div", ["class"=>"row mb-2"] );
    
        echo CHTML::campoLabel("Tipo:", "tipo").
        CHTML::campoListaDropDown("tipo",$dat["tipo"],
            Eventos::listaTiposEventos(),
            ["linea"=>"Sin seleccionar", "form"=>"filtrado", "class"=>"form-control", "style"=>"width:100%"]).PHP_EOL;
        
    echo CHTML::dibujaEtiquetaCierre("div");
        
    echo CHTML::dibujaEtiqueta("div", ["id"=>"divBtnFiltrado", "class"=>"row"]);
    
        echo CHTML::campoBotonSubmit("filtrar",["form"=>"filtrado","class"=>"btn btn-success ml-2 pl-4 pr-4"]);
        
    
    echo CHTML::dibujaEtiquetaCierre("div");
    
echo CHTML::dibujaEtiquetaCierre("div");

echo CHTML::finalizarForm();

echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
//fin formulario filtrado-------------------------


//dibuja etiqueta error
echo CHTML::modeloError($eventoUsuario, "cod_usuario", ["class"=>"alert alert-danger", "role"=>"alert",
                            "style"=>"color: #721c24; position: fixed; top: 60px; left: 60px; z-index:2;"], true).PHP_EOL;

if($participa){
    echo CHTML::dibujaEtiqueta("div", ["class"=>"alert alert-success text-left", "role"=>"alert",
        "style"=>"position: fixed; top: 60px; left: 60px; z-index:2;"], "", false).PHP_EOL;
    
    echo CHTML::dibujaEtiqueta("h4", ["class"=>"alert-heading"], "Fantastico!", true);
    
    echo CHTML::dibujaEtiqueta("p", [], "Inscripción realizada con éxito, mucha suerte!", true);
    
    echo CHTML::dibujaEtiquetaCierre("div");

}

if (isset($errores)) {
    echo CHTML::dibujaEtiqueta("div",["class"=>"alert alert-danger"], $errores, true).PHP_EOL;
}

echo CHTML::dibujaEtiqueta("div",["class"=>"text-left col-md-9"], "", false).PHP_EOL;

if (count($filas)==0){
    echo CHTML::dibujaEtiqueta("h1", ["style"=>"height: 60vh; margin-top: 10vh;"], "Lo sentimos, no actualmente no hay ningún evento disponible", true);
}

else{
    foreach($filas as $fila)
    {
        $this->dibujaVistaParcial("eventos_evento",["fila"=>$fila,
                                                 "usuario"=>$usuario,
                                                "eventoUsuario"=>$eventoUsuario
        ]);
    }
    
    //dibujo el paginador
    echo $pagi->dibujate();
}

echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;

echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;



























/*

 <!-- event-->
      <div class="container text-center container-event">
        <!-- header event-->
        <header class="bg-dark text-light head-event navbar">
          <div class="fas fa-minus mas-menos"></div>
          <div>Torneo</div>
        </header>
        <!-- header event-->

        <!-- main event-->
        <main class="body-event">
          <div class="background-black-event">
            <p class="h1 text-light title-event text-right mr-2">Campeonato de Andalucía alevín y cadete (Málaga)</p>
            <p class="text-light text-right mr-4 ml-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras
              aliquet sed tellus vel semper. Quisque pellentesque eu nisl sed ornare. Nulla vel fringilla enim.
              Phasellus pellentesque turpis nec ex convallis porta. Integer sem odio, rutrum in leo et, hendrerit
              vehicula dui. Nam mattis dignissim scelerisque. Donec pharetra tempor sem, aliquet sodales magna commodo
              venenatis. Quisque placerat ultrices cursus. Vestibulum posuere nunc eu posuere efficitur. Praesent eros
              orci, lobortis a purus non, varius euismod ante.</p>
          </div>
        </main>
        <!-- main event-->

        <!-- footer event-->
        <footer class="bg-dark text-light footer-event navbar row">
          <p class=" text-left col-6 col-md-7 order-1 order-md-1">25/12/2000</p>
          <button class="btn btn-success btn-participate col-12 col-md-3 order-3 order-md-2">Participar</button>
          <p class=" text-right col-6 col-md-2 order-2 order-md-3">12/50</p>
        </footer>
        <!-- footer event-->
      </div>
      <!-- event-->*/
