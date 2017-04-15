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
        $html = "";
        $html .="<h1> Certificado de anclaje para soportar caidas </h1>";
        $html .= $this->metaKey['post_title']. ' - ' . $this->metaKey['post_content'];
        return $html    ;

    }
}