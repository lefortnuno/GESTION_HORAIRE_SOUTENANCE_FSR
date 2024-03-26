<?php
// Chargement du XML et de la feuille de style XSLT
$xml = new DOMDocument();
$xml->load('../../files/xml/doctorants.xml');

$xsl = new DOMDocument();
$xsl->load('../../files/xslt/transform.xslt');

// Création du processeur XSLT
$xsltProcessor = new XSLTProcessor();
$xsltProcessor->importStylesheet($xsl);

// Application de la transformation
$html = $xsltProcessor->transformToXML($xml);

// Affichage du résultat HTML
echo $html;
?>