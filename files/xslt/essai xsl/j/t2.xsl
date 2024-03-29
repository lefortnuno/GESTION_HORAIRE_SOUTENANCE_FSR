<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <head>
    <title>Planning des soutenances</title>
    <style>
      table {
        border-collapse: collapse;
        width: 100%;
      }
      th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
      }
      th {
        background-color: #f2f2f2;
      }
    </style>
  </head>
  <body>
    <h1>Planning des soutenances</h1>
    <xsl:for-each select="submission/student[position() mod 9 = 1]">
      <h2>Journée <xsl:value-of select="position()"/></h2>
      <table>
        <tr>
          <th>Heure</th>
          <th>Étudiant</th>
        </tr>
        <xsl:variable name="dayStudents" select=". | following-sibling::student[position() &lt; 9]" />
        <xsl:for-each select="$dayStudents">
          <tr>
            <td><xsl:value-of select="concat(9 + (position() - 1) * 0.33, ':00')" /></td>
            <td><xsl:value-of select="author/lastname"/>, <xsl:value-of select="author/firstname"/> (<xsl:value-of select="theme"/>)</td>
          </tr>
        </xsl:for-each>
      </table>
    </xsl:for-each>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>
