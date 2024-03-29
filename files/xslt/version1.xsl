<!-- LOGIQ = NB ETUDIANTS PREDEFINI A 12/JOUR -->

<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Paramètres -->
  <xsl:param name="soutenanceParJour" select="12"/> <!-- Nombre d'étudiants à soutenir par jour -->
  <xsl:param name="dureeSoutenance" select="20"/> <!-- Durée de chaque soutenance en minutes -->
  <xsl:param name="pauseDuration" select="20"/> <!-- Durée de la pause entre chaque série de soutenances -->

  <!-- Template de correspondance pour l'élément racine -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Horaires de soutenance des étudiants</title>
        <style type="text/css">
          /* Définition des styles CSS */
          *{
            margin: 1%;
          }
          h1,
          h2,
          .titre {
            text-align: center;
          }
          .h1 {
            text-decoration: none;
            cursor: pointer;
            color: black;
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 20px;
          }
          table {
            width: 100%;
            border-collapse: collapse;
          }
          th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
          }
          th {
            background-color: #f2f2f2;
          }
          tr:nth-child(even) {
            background-color: #f2f2f2;
          }
        </style>
      </head>
      <body>
        <div class="titre">
            <a class="h1" href="programme.pdf" target="_blank">Horaires de soutenance des étudiants</a>
        </div>
        <!-- Pour chaque groupe d'étudiants par discipline -->
        <xsl:for-each-group select="//student" group-by="disciplines">

          <!-- Titre de la discipline -->
          <h2>Groupe - <xsl:value-of select="current-grouping-key()" /></h2> 
          
          <table border="1">
            <tr>
              <th>Code Apogée</th>
              <th>Nom et Prénom</th>
              <th>Thème</th>
              <th>Date de soutenance</th>
              <th>Horaire de soutenance</th>
            </tr>
            <!-- Appliquer le template pour chaque étudiant du groupe, trié par nom -->
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
    <!-- Calcul de l'index de l'étudiant dans la liste totale -->
    <xsl:variable name="index" select="position()"/>
    <!-- Calcul du numéro de jour de la soutenance -->
    <xsl:variable name="jour" select="ceiling($index div $soutenanceParJour)"/>
    <!-- Calcul de l'heure de début de la soutenance -->
    <xsl:variable name="minuteDebut" select="(($index - 1) mod $soutenanceParJour) * $dureeSoutenance"/>
    <xsl:variable name="heureDebut" select="if ($index mod $soutenanceParJour &gt; 6) then 12 else 9"/>
    <xsl:variable name="heureDebut" select="$heureDebut + floor($minuteDebut div 60)"/>
    <xsl:variable name="minuteDebutAffiche" select="$minuteDebut mod 60"/>
    <!-- Calcul de l'heure de fin de la soutenance -->
    <xsl:variable name="heureFin" select="if ($index mod $soutenanceParJour &gt; 6) then 12 else 9"/>
    <xsl:variable name="heureFin" select="$heureFin + floor(($minuteDebut + $dureeSoutenance) div 60)"/>
    <xsl:variable name="minuteFin" select="($minuteDebut + $dureeSoutenance) mod 60"/>
    <!-- Affichage des informations de l'étudiant avec les heures de début et de fin -->
    <tr>
      <td><xsl:value-of select="author/@codeApogee"/></td>
      <td><xsl:value-of select="concat(author/firstname, ' ', author/lastname)"/></td>
      <td><xsl:value-of select="theme"/></td>
      <td><xsl:value-of select="concat(format-number($jour, '00'), '/03/2024')"/></td>
      <td><xsl:value-of select="concat(format-number($heureDebut, '00'), ':', format-number($minuteDebutAffiche, '00'))"/> - <xsl:value-of select="concat(format-number($heureFin, '00'), ':', format-number($minuteFin, '00'))"/></td>
    </tr>
    <!-- Ajout de la pause après chaque série de 3 soutenances -->
    <xsl:if test="$index mod 3 = 0">
      <tr>
        <td colspan="5" style="text-align:center; background-color: lightgray; visibility: hidden;">
        Pause de <xsl:value-of select="$pauseDuration"/> minutes
        </td>
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
