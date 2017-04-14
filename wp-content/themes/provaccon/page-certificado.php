<?php
include 'dompdf/autoload.inc.php';
include 'functions/PostPdf.php';
use Dompdf\Dompdf;

$postPdf = new PostPdf($_GET['numero_cerficado']);
if(!$html = $postPdf->getHtml()){
    header("Location: ". get_site_url() ."/certificacion-de-puntos-de-anclajes?error=true");
    exit();
}
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->stream($postPdf->getName());


