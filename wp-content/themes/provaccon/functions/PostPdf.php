<?php

/**
 * Created by PhpStorm.
 * User: juan2ramos
 * Date: 13/04/17
 * Time: 11:59 PM
 */
class PostPdf
{
    private $number;
    private $metaKey;

    function __construct($number)
    {
        $this->number = $number;
    }

    function getHtml()
    {
        global $wpdb;
        $posts = $wpdb->get_results(
            "SELECT pro_posts.post_title,pro_posts.post_name, pro_posts.post_content, pro_posts.post_status, pro_postmeta.*
    FROM pro_postmeta INNER  JOIN  pro_posts 
    ON pro_postmeta.`post_id` = `pro_posts`.id  
    where post_id = 
    ( SELECT post_id FROM pro_postmeta   where meta_key = 'numero_cerficado' and meta_value = " . $this->number . "
    )");
        if (!$posts) {
            return false;
        }
        $metaKey = [];

        foreach ($posts as $post) {
            $metaKey[$post->meta_key] = $post->meta_value;
        }
        print_r($post);exit;
        $metaKey['post_title']= $post->post_title;
        $metaKey['post_content']= $post->post_content;
        $metaKey['post_status']= $post->post_status;
        $metaKey['post_name']= $post->post_name;
        $this->metaKey = $metaKey;
        return $this->generateHtml();
    }
    public function getName(){
        return $this->metaKey['post_name'] . '-' . $this->metaKey['numero_cerficado'] . '.pdf';
    }
    private function generateHtml(){
        $root = $_SERVER["DOCUMENT_ROOT"];
        $html = "";
        $html .=  "<img width='700'  src='".$root."/wp-content/themes/provaccon/assets/img/h.svg' >";
        $html .="<div style=\"width:700px;margin:auto\">
<h2 style='text-align:center'><b>CERTIFICACIÓN DE ANCLAJES PARA TRABAJOS EN ALTURAS</b></h2>

<p style='text-align:center'><b><u>INFORMACIÓN GENERAL DELSOLICITANTE</u></b></p>

<p class=MsoNoSpacing><b>NOMBRE O RAZÓN SOCIAL:</b></p>

<p ><b><span >NÚMERO DE IDENTIFICACIÓN O NIT:</span></b></p>

<p ><b ><span lang=ES-CO>DIRECCIÓN:MUNICIPIO:</b></p>

<p ><b><span lang=ES-CO>TELÉFONO:<span>;E-MAIL:</span></b></p>

<p style='text-align:center'><b><u>INFORMACIÓN DEL ANCLAJE</u></b></p>

<table border=1 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none;'>
 <tr >
  <td width=160 valign=top style='width:160pt;border:double 1.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
		
  <p style='text-align:center'><b>TIPO DE ANCLAJE.</b></p>
  </td>
  <td width=160 valign=top style='width:160pt;border:double  1.5pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p  style='text-align:center'><b>ESPECIFICACIÓN.</b></p></td>
	 
  <td width=160 valign=top style='width:160pt;border:double  1.5pt;
  border-left:none;mso-border-left-alt:double  1.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p style='text-align:center'><b>REGISTRO FOTOGRÁFICO.</b></p>
</td>
 </tr>
 <tr style='height:22.65pt'>
  <td width=147 valign=top style='width:147.1pt;border:double  1.5pt;
  border-top:none;mso-border-top-alt:double  1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.65pt'>
  <p> asdfg </p>
  </td>
  <td width=147 rowspan=3 valign=top style='width:147.15pt;border-top:none;
  border-left:none;border-bottom:double  1.5pt;border-right:double  1.5pt;
  mso-border-top-alt:double  1.5pt;mso-border-left-alt:double  1.5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.65pt'>
  <p>asdfg</p>
  </td>
  <td width=147 rowspan=3 valign=top style='width:147.15pt;border-top:none;
  border-left:none;border-bottom:double  1.5pt;border-right:double  1.5pt;
  mso-border-top-alt:double  1.5pt;mso-border-left-alt:double  1.5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.65pt'>
  <p style='text-align:center'><b><span style='color:#BFBFBF;'>FOTO</span></b></p>
  </td>
 </tr>
 <tr>
  <td width=147 valign=top style='width:147.1pt;border:double  1.5pt;
  border-top:none;mso-border-top-alt:double  1.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p style='text-align:center'><b><span >UBICACIÓN.</span></b></p>
  </td>
 </tr>
 <tr style='height:60.85pt'>
  <td width=147 valign=top style='width:147.1pt;border:double  1.5pt;
  border-top:none;mso-border-top-alt:double  1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:60.85pt'>
  <p >asdfg</p>
  </td>
 </tr>
</table>

<p><b><span >NormasAplicables Vigentes:&nbsp;&nbsp;&nbsp; <span style='mso-tab-count:1'> </span>*
Resolución 1409 del 2012,&nbsp;&nbsp;&nbsp;<span style='mso-spacerun:yes'>&nbsp; </span>* Norma
UNE EN 795 de 2012</span></b></p>

<p style='text-align:center'><b>*
Norma UNE EN 795 del 2001.</b></p>

<p ><b>Prueba realizada:</b><span> Se aplica una fuerza de<span>&nbsp; </span>tensión de 1000 dN durante 180 segundos;
La fuerza no puede disminuir más del 5% de la carga aplicada / (<b>UNE EN 795 del 2012</b>).</span></p>
<p>&nbsp;</p>
<p align=center style='text-align:center'><b>RESULTADO DE LA PRUEBA
SOBRE EL ANCLAJE:</b></p>
<div>
<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:double  1.5pt;
 mso-yfti-tbllook:1184;'>
 <tr>
  <td width=88 valign=top style='width:88.25pt;border:double  1.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p style='text-align:center'><b>ANCLAJE N°</b></p>
  </td>
  <td width=88 valign=top style='width:88.25pt;border:double windowtext 1.5pt;
  border-left:none;mso-border-left-alt:double windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p style='text-align:center'><b>Lectura Inicial:</b></p>
  </td>
  <td width=88 valign=top style='width:88.3pt;border:double windowtext 1.5pt;
  border-left:none;mso-border-left-alt:double windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNoSpacing align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><span lang=ES-CO>Lectura Final:<o:p></o:p></span></b></p>
  </td>
  <td width=88 valign=top style='width:88.3pt;border:double windowtext 1.5pt;
  border-left:none;mso-border-left-alt:double windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNoSpacing align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><span lang=ES-CO>Tiempo:<o:p></o:p></span></b></p>
  </td>
  <td width=88 valign=top style='width:88.3pt;border:double windowtext 1.5pt;
  border-left:none;mso-border-left-alt:double windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNoSpacing align=center style='text-align:center'><b
  style='mso-bidi-font-weight:normal'><span lang=ES-CO>Resultado:<o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes'>
  <td width=88 valign=top style='width:92pt;border:double windowtext 1.5pt;
  border-top:none;mso-border-top-alt:double windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p >asdfg</p>
  </td>
  <td width=88 valign=top style='width:91pt;border-top:none;border-left:
  none;border-bottom:double windowtext 1.5pt;border-right:double windowtext 1.5pt;
  mso-border-top-alt:double windowtext 1.5pt;mso-border-left-alt:double windowtext 1.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
 <p >asdfg</p>
  </td>
  <td width=88 valign=top style='width:91pt;border-top:none;border-left:none;
  border-bottom:double windowtext 1.5pt;border-right:double windowtext 1.5pt;
  mso-border-top-alt:double windowtext 1.5pt;mso-border-left-alt:double windowtext 1.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
 <p >asdfg</p>
  </td>
  <td width=88 valign=top style='width:91pt;border-top:none;border-left:none;
  border-bottom:double windowtext 1.5pt;border-right:double windowtext 1.5pt;
  mso-border-top-alt:double windowtext 1.5pt;mso-border-left-alt:double windowtext 1.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p >asdfg</p>
  </td>
  <td width=88 valign=top style='width:91pt;border-top:none;border-left:none;
  border-bottom:double windowtext 1.5pt;border-right:double windowtext 1.5pt;
  mso-border-top-alt:double windowtext 1.5pt;mso-border-left-alt:double windowtext 1.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p >asdfg</p>
  </td>
 </tr>
</table>

</div>
<p>&nbsp;</p>
<p ><b>ANCLAJEAPROBADO:</b></p>
<p ><b>CAPACIDAD
DEL ANCLAJE: 5.000 Libras y uno (1) solo operario/trabajador ancado al punto.</b></p>



<p><b>Fecha de Certificación:Fecha de Expiración:</b></p>



<p style='text-align:justify'><b><u><span>Nota:</span></u></b><span> Después de ser certificado se recomienda realizar inspecciones cuando se sospeche de ser usado en actividades diferente a las propias del <b>punto de anclaje,</b> después de recibir impactos, cargas súbitas o muestre signos de deterioro y cuando expire su certificado.</span></p>
<p>&nbsp;</p>
	
<p style='text-align:center;margin: 6px;'><b>Ing. MIGUEL ÁNGEL BASTIDAS MUÑOZ</b></p>
<p style='text-align:center;margin: 6px'>WWW.PROVACCON.COM</p>
<p style='text-align:center;margin: 6px'>NIT: 900.821.892-0</p>
<p style='text-align:center;margin: 6px'>info@provaccon.com</p>

</div>
<img width='700'  src='$root/wp-content/themes/provaccon/assets/img/firma.png' >
";
        print_r("$root/wp-content/themes/provaccon/assets/img/firma.png");exit;
        $html .= $this->metaKey['post_title']. ' - ' . $this->metaKey['post_content'];

        return $html    ;

    }
}