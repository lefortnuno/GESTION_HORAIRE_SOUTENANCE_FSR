<!-- LOGIQ = HEURE PLACER ET PREDEFINI  -->

<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Paramètres -->
  <xsl:param name="dureeSoutenance" select="20"/> <!-- Durée de chaque soutenance en minutes -->

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
    <xsl:variable name="jour" select="ceiling($index div 12)"/>
    <!-- Liste des heures de soutenance prédéfinies -->
    <xsl:variable name="hours">
      <hour>9:00 - 9:20</hour>
      <hour>9:20 - 9:40</hour>
      <hour>9:40 - 10:00</hour>
      <hour>10:30 - 10:50</hour>
      <hour>10:50 - 11:10</hour>
      <hour>11:10 - 11:30</hour>
      <hour>14:00 - 14:20</hour>
      <hour>14:20 - 14:40</hour>
      <hour>14:40 - 15:00</hour>
      <hour>15:30 - 15:50</hour>
      <hour>15:50 - 16:10</hour>
      <hour>16:10 - 16:30</hour>
    </xsl:variable>
    <!-- Sélection de l'heure de soutenance en fonction de l'index -->
    <xsl:variable name="hourIndex" select="($index - 1) mod 12"/>
    <!-- Affichage des informations de l'étudiant avec l'heure de soutenance -->
    <tr>
      <td><xsl:value-of select="author/@codeApogee"/></td>
      <td><xsl:value-of select="concat(author/firstname, ' ', author/lastname)"/></td>
      <td><xsl:value-of select="theme"/></td>
      <td><xsl:value-of select="concat(format-number($jour, '00'), '/03/2024')"/></td>
      <td><xsl:value-of select="$hours/hour[$hourIndex + 1]"/></td>
    </tr>
  </xsl:template>

</xsl:stylesheet>
