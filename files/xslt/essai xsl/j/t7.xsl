<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="html" indent="yes"/>

<xsl:template match="/">
  <html>
  <head>
    <title>Horaires de soutenance des étudiants</title>
    <style>
      table {
        width: 100%;
        border-collapse: collapse;
      }
      th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
      }
    </style>
  </head>
  <body>
    <h1>Horaires de soutenance des étudiants</h1>
    <table>
      <tr>
        <th>Code Apogée</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Thème</th>
        <th>Discipline</th>
        <th>Date de soutenance</th>
        <th>Horaire de soutenance</th>
      </tr>
      <xsl:apply-templates select="//student"/>
    </table>
  </body>
  </html>
</xsl:template>

<xsl:template match="student">
  <xsl:variable name="soutenanceIndex" select="position()"/>
  <xsl:variable name="soutenanceDay" select="ceiling($soutenanceIndex div 9)"/>
  <xsl:variable name="soutenanceTime" select="concat(9 + floor(($soutenanceIndex mod 9) * 20 div 60), ':', format-number(($soutenanceIndex mod 9) * 20 mod 60, '00'))"/>
  <tr>
    <td><xsl:value-of select="author/@codeApogee"/></td>
    <td><xsl:value-of select="author/lastname"/></td>
    <td><xsl:value-of select="author/firstname"/></td>
    <td><xsl:value-of select="theme"/></td>
    <td><xsl:value-of select="disciplines"/></td>
    <td><xsl:value-of select="concat('Jour ', $soutenanceDay)"/></td>
    <td><xsl:value-of select="$soutenanceTime"/></td>
  </tr>
</xsl:template>

</xsl:stylesheet>
