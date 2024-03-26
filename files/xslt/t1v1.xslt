<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Correspondance des balises XML aux éléments HTML -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Liste des étudiants</title>
        <style>
          /* Style CSS facultatif */
          table {
            width: 100%;
            border-collapse: collapse;
          }
          th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
          }
          th {
            background-color: #f2f2f2;
          }
        </style>
      </head>
      <body>
        <h1>Liste des étudiants</h1>
        <table>
          <tr>
            <th>Code Apogée</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Discipline</th>
            <th>Thème</th>
          </tr>
          <!-- Boucle à travers chaque étudiant -->
          <xsl:for-each select="submission/student">
            <!-- Tri par ordre alphabétique des noms -->
            <xsl:sort select="author/firstname"/>
            <tr>
              <td><xsl:value-of select="author/@codeApogee"/></td>
              <td><xsl:value-of select="author/firstname"/></td>
              <td><xsl:value-of select="author/lastname"/></td>
              <td><xsl:value-of select="disciplines"/></td>
              <td><xsl:value-of select="theme"/></td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>

</xsl:stylesheet>
