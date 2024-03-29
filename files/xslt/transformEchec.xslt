<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" indent="yes"/>

  <!-- Template to match the root node -->
  <xsl:template match="/">
    <html>
    <head>
      <title>Horaire des soutenances</title>
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
        th {
          background-color: #f2f2f2;
        }
      </style>
    </head>
    <body>
      <h2>Horaire des soutenances :</h2>
      <table>
        <tr>
          <th>Code Apogée</th>
          <th>Nom et prénom</th>
          <th>Date</th>
          <th>Horaire</th>
          <th>Thème</th>
          <th>Salle</th>
        </tr>
        <!-- Apply templates to each student -->
        <xsl:apply-templates select="//student">
          <xsl:sort select="author/lastname"/>
        </xsl:apply-templates>
      </table>
    </body>
    </html>
  </xsl:template>

  <!-- Template to match each student -->
  <xsl:template match="student">
    <xsl:variable name="presentationDuration" select="20"/> <!-- Durée de présentation en minutes -->
    <xsl:variable name="studentIndex" select="position()"/> <!-- Position de l'étudiant dans la liste -->
    <xsl:variable name="startHour" select="9"/> <!-- Heure de début des soutenances -->
    <xsl:variable name="endHour" select="16"/> <!-- Heure de fin des soutenances -->
    <xsl:variable name="startMinute" select="($studentIndex - 1) * $presentationDuration"/> <!-- Minute de début pour cet étudiant -->
    <xsl:variable name="heureDebut" select="floor(($startHour * 60 + $startMinute) div 60)"/> <!-- Heure de début pour cet étudiant -->
    <xsl:variable name="minuteDebut" select="($startHour * 60 + $startMinute) mod 60"/> <!-- Minute de début pour cet étudiant -->
    <xsl:variable name="endMinute" select="$startMinute + $presentationDuration"/> <!-- Minute de fin pour cet étudiant -->
    <xsl:variable name="heureFin" select="floor(($startHour * 60 + $endMinute) div 60)"/> <!-- Heure de fin pour cet étudiant -->
    <xsl:variable name="minuteFin" select="$endMinute mod 60"/> <!-- Minute de fin pour cet étudiant -->
    <tr>
      <td><xsl:value-of select="author/@codeApogee"/></td>
      <td><xsl:value-of select="concat(author/firstname, ' ', author/lastname)"/></td>
      <td><xsl:value-of select="'2024-03-26'"/></td>
      <td><xsl:value-of select="concat(format-number($heureDebut, '00'), ':', format-number($minuteDebut, '00'), ' - ', format-number($heureFin, '00'), ':', format-number($minuteFin, '00'))"/></td>
      <td><xsl:value-of select="theme"/></td>
      <td><xsl:value-of select="concat('Salle ', disciplines)"/></td>
    </tr>
  </xsl:template>
</xsl:stylesheet>
