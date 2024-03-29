<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" encoding="UTF-8"/>

  <xsl:template match="/">
    <html lang="fr">
      <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Planning des soutenances</title>
      </head>
      <body>
        <div class="container">
          <h1 class="page-header text-center mt-5 mb-4">Planning des soutenances</h1>
          <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Horaire</th>
                <th>Code Apogée</th>
                <th>Nom et Prénom</th>
                <th>Thème</th>
                <th>Salle</th>
              </tr>
            </thead>
            <tbody>
              <xsl:apply-templates select="submission/student"/>
            </tbody>
          </table>
        </div>
      </body>
    </html>
  </xsl:template>

  <xsl:template match="student">
    <tr>
      <td>
        <xsl:value-of select="author/birth"/>
      </td>
      <td>
        <xsl:value-of select="author/birth"/>
      </td>
      <td>
        <xsl:value-of select="author/@codeApogee"/>
      </td>
      <td>
        <xsl:value-of select="concat(author/firstname, ' ', author/lastname)"/>
      </td>
      <td>
        <xsl:value-of select="theme"/>
      </td>
      <td>
        <xsl:value-of select="concat('Salle ', disciplines)"/>
      </td>
    </tr>
  </xsl:template>
</xsl:stylesheet>
