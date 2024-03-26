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
        <xsl:apply-templates select="//student"/>
      </table>
    </body>
    </html>
  </xsl:template>

  <!-- Template to match each student -->
  <xsl:template match="student">
    <xsl:variable name="presentationDuration" select="20"/> <!-- Durée de présentation en minutes -->
    <xsl:variable name="studentIndex" select="position()"/> <!-- Position de l'étudiant dans la liste -->
    <xsl:variable name="dateDebut">
      <xsl:value-of select="'2024-03-26'"/> <!-- Date de début des soutenances -->
    </xsl:variable>
    <xsl:variable name="heureDebut">
      <xsl:value-of select="9 + floor((($studentIndex - 1) * $presentationDuration) div 60)"/> <!-- Heure de début pour cet étudiant -->
    </xsl:variable>
    <xsl:variable name="minuteDebut">
      <xsl:value-of select="(($studentIndex - 1) * $presentationDuration) mod 60"/> <!-- Minute de début pour cet étudiant -->
    </xsl:variable>
    <xsl:variable name="heureFin">
      <xsl:value-of select="9 + floor(($studentIndex * $presentationDuration) div 60)"/> <!-- Heure de fin pour cet étudiant -->
    </xsl:variable>
    <xsl:variable name="minuteFin">
      <xsl:value-of select="($studentIndex * $presentationDuration) mod 60"/> <!-- Minute de fin pour cet étudiant -->
    </xsl:variable>
    <tr>
      <td><xsl:value-of select="author/@codeApogee"/></td>
      <td><xsl:value-of select="concat(author/firstname, ' ', author/lastname)"/></td>
      <td><xsl:value-of select="$dateDebut"/></td>
      <td><xsl:value-of select="concat(format-number($heureDebut, '00'), ':', format-number($minuteDebut, '00'), ' - ', format-number($heureFin, '00'), ':', format-number($minuteFin, '00'))"/></td>
      <td><xsl:value-of select="theme"/></td>
      <td><xsl:value-of select="concat('Salle ', disciplines)"/></td>
    </tr>
  </xsl:template>
</xsl:stylesheet>
