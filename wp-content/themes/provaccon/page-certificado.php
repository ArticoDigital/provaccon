<?php
include 'dompdf-master/autoload.inc.php';
include 'functions/PostPdf.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$postPdf = new PostPdf($_GET['numero_cerficado']);
if(!$html = $postPdf->getHtml()){
    header("Location: ". get_site_url() ."/certificacion-de-puntos-de-anclajes?error=true");
    exit();
}
$options = new Options();
$options->set('defaultFont', 'Courier');
$options->setIsRemoteEnabled(true);
$options->set('isRemoteEnabled', true);
$options->set('debugKeepTemp', TRUE);
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$dompdf->stream($postPdf->getName());


