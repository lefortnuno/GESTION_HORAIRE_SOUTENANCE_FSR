<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" indent="yes"/>
    
    <!-- Paramètres -->
    <xsl:param name="soutenanceParJour" select="9"/>
    <xsl:param name="dureeSoutenance" select="20"/>
    <xsl:param name="heureDebutSoutenance" select="9"/>
    
    <!-- Template principal -->
    <xsl:template match="/">
        <html>
            <head>
                <title>Horaires de soutenance</title>
            </head>
            <body>
                <h1>Horaires de soutenance des étudiants</h1>
                <table border="1">
                    <tr>
                        <th>Code Apogee</th>
                        <th>Nom et Prénom</th>
                        <th>Thème</th>
                        <th>Discipline</th>
                        <th>Date de soutenance</th>
                        <th>Horaire de soutenance</th>
                    </tr>
                    <!-- Appel du template pour chaque étudiant -->
                    <xsl:apply-templates select="//student"/>
                </table>
            </body>
        </html>
    </xsl:template>
    
    <!-- Template pour chaque étudiant -->
    <xsl:template match="student">
        <!-- Calcul de l'heure de soutenance -->
        <xsl:variable name="jour" select="position() div $soutenanceParJour + 1"/>
        <xsl:variable name="heure" select="$heureDebutSoutenance + floor((position() - 1) mod $soutenanceParJour)"/>
        <xsl:variable name="minute" select="($dureeSoutenance * (position() mod $soutenanceParJour)) mod 60"/>
        
        <tr>
            <td><xsl:value-of select="author/@codeApogee"/></td>
            <td><xsl:value-of select="concat(author/firstname, ' ', author/lastname)"/></td>
            <td><xsl:value-of select="theme"/></td>
            <td><xsl:value-of select="disciplines"/></td>
            <td><xsl:value-of select="concat('Jour ', $jour)"/></td>
            <td><xsl:value-of select="concat($heure, ':', format-number($minute, '00'))"/></td>
        </tr>
    </xsl:template>
</xsl:stylesheet>
