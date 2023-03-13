<?php
require_once ('../dompdf/autoload.inc.php');
use Dompdf\Dompdf;
?>


 <?php
   
   function testfun()
    {
      // instantiate and use the dompdf class

      $html =
      
       '<html><body>'.

       '<p>Registro de Prestamos: '.$_POST['compilado'].

       '</body></html>';

       $dompdf = new DOMPDF(); 
       $options = $dompdf->getOptions();
       $options->setIsHtml5ParserEnabled(true);
       $dompdf->load_html($html);
       ob_end_clean();
       $dompdf->render();

       // Output the generated PDF to Browser
       $dompdf->stream("Reporte_Prestamos");
   }
   
   if(array_key_exists('compilado', $_POST)){
      testfun();
   }
   
   ?>