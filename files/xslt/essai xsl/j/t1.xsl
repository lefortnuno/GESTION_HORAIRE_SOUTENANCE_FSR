<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <head>
    <title>Informations des étudiants</title>
  </head>
  <body>
    <h1>Informations des étudiants</h1>
    <table border="1">
      <tr>
        <th>Code Apogee</th>
        <th>Nom et Prénom</th>
        <th>Thème</th>
        <th>Discipline</th>
      </tr>
      <xsl:for-each select="submission/student">
      <tr>
        <td><xsl:value-of select="author/@codeApogee"/></td>
        <td><xsl:value-of select="author/lastname"/> <xsl:value-of select="author/firstname"/></td>
        <td><xsl:value-of select="theme"/></td>
        <td><xsl:value-of select="disciplines"/></td>
      </tr>
      </xsl:for-each>
    </table>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>
