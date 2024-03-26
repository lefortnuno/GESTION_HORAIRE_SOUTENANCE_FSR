<?php
// Charger le fichier XML
$xml = new DOMDocument();
if (!$xml->load('../../files/xml/doctorants.xml')) {
    die ('Erreur lors du chargement du fichier XML');
}

// Charger le fichier XSLT
$xsl = new DOMDocument();
if (!$xsl->load('../../files/xslt/transform.xslt')) {
    die ('Erreur lors du chargement du fichier XSLT');
}
// Créer un processeur XSLT
$proc = new XSLTProcessor();

// Attacher la feuille de style XSLT
if (!$proc->importStyleSheet($xsl)) {
    die ('Erreur lors de l\'importation de la feuille de style XSLT');
}
// Transformer le document XML
$result = $proc->transformToXML($xml);

echo $result;

?>