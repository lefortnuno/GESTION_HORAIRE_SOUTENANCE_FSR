<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <!-- Paramètres -->
  <xsl:param name="soutenanceDuration" select="20"/> <!-- Durée de soutenance en minutes -->
  <xsl:param name="studentsPerDay" select="9"/>      <!-- Nombre d'étudiants par jour -->
  <xsl:param name="startTime" select="9"/>           <!-- Heure de début de la journée de soutenance -->

  <!-- Template principal -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Horaires de Soutenance</title>
        <style>
          table {
            border-collapse: collapse;
            width: 100%;
          }
          th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
          }
        </style>
      </head>
      <body>
        <h1>Horaires de Soutenance</h1>
        <table>
          <tr>
            <th>Code Apogée</th>
            <th>Nom et Prénom</th>
            <th>Thème</th>
            <th>Discipline</th>
            <th>Date de Soutenance</th>
            <th>Horaire de Soutenance</th>
          </tr>
          <xsl:apply-templates select="//student"/>
        </table>
      </body>
    </html>
  </xsl:template>

  <!-- Template pour chaque étudiant -->
  <xsl:template match="student">
    <xsl:variable name="studentIndex" select="position()"/>
    <xsl:variable name="dayNumber" select="ceiling($studentIndex div $studentsPerDay)"/>
    <xsl:variable name="minuteOffset" select="($studentIndex - 1) * $soutenanceDuration"/>
    <xsl:variable name="soutenanceHour" select="$startTime + floor(($minuteOffset + 1) div 60)"/>
    <xsl:variable name="soutenanceMinute" select="($minuteOffset + 1) mod 60"/>
    <tr>
      <td><xsl:value-of select="author/@codeApogee"/></td>
      <td><xsl:value-of select="concat(author/firstname, ' ', author/lastname)"/></td>
      <td><xsl:value-of select="theme"/></td>
      <td><xsl:value-of select="disciplines"/></td>
      <td><xsl:value-of select="concat('Jour ', $dayNumber)"/></td>
      <td><xsl:value-of select="concat(format-number($soutenanceHour, '00'), ':', format-number($soutenanceMinute, '00'))"/></td>
    </tr>
  </xsl:template>

</xsl:stylesheet>
