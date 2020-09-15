<?php 

$this->textoHead.=PHP_EOL.CPager::requisitos();


$pagi=new CPager($opcPag,array());




echo CHTML::dibujaEtiqueta("div",["class"=>"container"], "", false).PHP_EOL;

    echo CHTML::dibujaEtiqueta("div",["class"=>"row"], "", false).PHP_EOL;
    
        echo CHTML::dibujaEtiqueta("div",["class"=>"col-0 col-lg-2"], "", true).PHP_EOL;
        
        echo CHTML::dibujaEtiqueta("div",["class"=>"col-12 col-lg-8"], "", false).PHP_EOL;
        
            echo CHTML::dibujaEtiqueta("div",["class"=>"text-left row"], "", false).PHP_EOL;

            echo CHTML::dibujaEtiqueta("div",["class"=>"mt-3 col-12"], "<h1 id='jutenis'>Jutenis</h1>", true).PHP_EOL;
            
            echo CHTML::dibujaEtiqueta("div",["class"=>"mt-2 mb-2 col-12 barra"], "ÚLTIMAS NOTICIAS", true).PHP_EOL;

            

$contador = 0;

foreach($filas as $fila)
{
    $contador++;
    $this->dibujaVistaParcial("noticias_noticia",["fila"=>$fila, "cont"=>$contador]);
}



            echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
    
            //dibujo el paginador
            echo $pagi->dibujate();
            
            echo CHTML::dibujaEtiqueta("div",["class"=>"mb-3"], "", true).PHP_EOL;
    
            echo CHTML::dibujaEtiquetaCierre("div").PHP_EOL;
    
        echo CHTML::dibujaEtiqueta("div",["class"=>"col-0 col-lg-2"], "", true).PHP_EOL;
    
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
