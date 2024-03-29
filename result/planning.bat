cd C:\wamp64\www\PROJET\GESTION_HORAIRE_SOUTENANCE_FSR\result 
java -jar C:\SaxonHE12-4J\saxon-he-12.4.jar -s:doctorants.xml -xsl:transformation.xsl -o:index.html 
wkhtmltopdf index.html programme.pdf 
programme.pdf 
