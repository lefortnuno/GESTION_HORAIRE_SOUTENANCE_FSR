<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Paramètres -->
  <xsl:param name="soutenanceParJour" select="12"/>
  <xsl:param name="dureeSoutenance" select="20"/>
  <xsl:param name="pauseDuration" select="20"/>

  <!-- Template de correspondance pour l'élément racine -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Horaires de soutenance des étudiants</title>
      </head>
      <body>
        <h1>Horaires de soutenance des étudiants</h1>
        <xsl:for-each-group select="//student" group-by="disciplines">
          <h2><xsl:value-of select="current-grouping-key()"/></h2>
          <table border="1">
            <tr>
              <th>Code Apogée</th>
              <th>Nom et Prénom</th>
              <th>Thème</th>
              <th>Date de soutenance</th>
              <th>Horaire de soutenance</th>
            </tr>
            <xsl:apply-templates select="current-group()">
              <xsl:sort select="concat(author/lastname, author/firstname)" />
            </xsl:apply-templates>
          </table>
        </xsl:for-each-group>
      </body>
    </html>
  </xsl:template>

  <!-- Template de correspondance pour chaque étudiant -->
  <xsl:template match="student">
    <xsl:variable name="index" select="position()"/>
    <xsl:variable name="jour" select="ceiling($index div $soutenanceParJour)"/>
    <!-- Calcul de l'heure de début en fonction du nombre d'étudiants déjà passés -->
    <xsl:variable name="heureDebut">
      <xsl:choose>
        <xsl:when test="$index mod $soutenanceParJour &gt; 6">
          <!-- Si plus de 6 étudiants sont déjà passés, l'heure de début est 12:00 -->
          <xsl:text>12</xsl:text>
        </xsl:when>
        <xsl:otherwise>
          <!-- Sinon, l'heure de début est 9:00 -->
          <xsl:text>9</xsl:text>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    <!-- Calcul de l'heure de fin -->
    <xsl:variable name="minuteDebut" select="(($index - 1) mod $soutenanceParJour) * $dureeSoutenance"/>
    <xsl:variable name="heureDebutFinal" select="$heureDebut + floor($minuteDebut div 60)"/>
    <xsl:variable name="minuteDebutFinal" select="$minuteDebut mod 60"/>
    <xsl:variable name="minuteFin" select="$minuteDebut + $dureeSoutenance"/>
    <xsl:variable name="heureFin" select="$heureDebutFinal + floor($minuteFin div 60)"/>
    <xsl:variable name="minuteFinFinal" select="$minuteFin mod 60"/>
    <tr>
      <td><xsl:value-of select="author/@codeApogee"/></td>
      <td><xsl:value-of select="concat(author/firstname, ' ', author/lastname)"/></td>
      <td><xsl:value-of select="theme"/></td>
      <td><xsl:value-of select="concat(format-number($jour, '00'), '/03/2024')"/></td>
      <td><xsl:value-of select="concat(format-number($heureDebutFinal, '00'), ':', format-number($minuteDebutFinal, '00'))"/> - <xsl:value-of select="concat(format-number($heureFin, '00'), ':', format-number($minuteFinFinal, '00'))"/></td>
    </tr>
    <!-- Ajout de la pause après chaque série de 3 soutenances -->
    <xsl:if test="$index mod 3 = 0">
      <tr>
        <td colspan="5" style="text-align:center; background-color: lightgray;">Pause de <xsl:value-of select="$pauseDuration"/> minutes</td>
      </tr>
    </xsl:if>
    <!-- Affichage de "Fin de journée" à la fin de chaque journée de soutenance -->
    <xsl:if test="$index mod $soutenanceParJour = 0">
      <tr>
        <td colspan="5" style="text-align:center; background-color: lightgray;">Fin de journée</td>
      </tr>
    </xsl:if>
  </xsl:template>

</xsl:stylesheet>
