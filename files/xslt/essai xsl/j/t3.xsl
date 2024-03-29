<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:variable name="numStudentsPerDay" select="9"/>

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
    </style>
  </head>
  <body>
    <h1>Planning des soutenances</h1>
    <xsl:apply-templates select="submission/student"/>
  </body>
  </html>
</xsl:template>

<xsl:template match="student">
  <xsl:variable name="year" select="substring(registrationYear, 1, 4)"/>
  <h2>Journée de soutenances pour le <xsl:value-of select="$year"/></h2>
  <table>
    <tr>
      <th>Heure</th>
      <th>Étudiant</th>
    </tr>
    <xsl:call-template name="generateSlots">
      <xsl:with-param name="students" select="."/>
      <xsl:with-param name="year" select="$year"/>
    </xsl:call-template>
  </table>
</xsl:template>

<xsl:template name="generateSlots">
  <xsl:param name="students"/>
  <xsl:param name="year"/>
  <xsl:variable name="startTime" select="'09:00'"/>
  <xsl:variable name="slotDuration" select="20"/>
  <xsl:variable name="remainingStudents" select="$students[not(following-sibling::student[substring(registrationYear, 1, 4) = $year]) or position() &lt; $numStudentsPerDay]"/>
  <xsl:variable name="numRemainingStudents" select="count($remainingStudents)"/>
  
  <!-- Générer les créneaux horaires -->
  <xsl:for-each select="$remainingStudents">
    <xsl:variable name="slotIndex" select="position()"/>
    <xsl:variable name="slotStartTime" select="format-number(number(substring($startTime, 1, 2)) + floor(($slotIndex - 1) * $slotDuration div 60), '00')"/>
    <xsl:variable name="slotStartMinutes" select="format-number(($slotIndex - 1) * $slotDuration mod 60, '00')"/>
    <tr>
      <td>
        <xsl:value-of select="$slotStartTime"/>:<xsl:value-of select="$slotStartMinutes"/>
        - 
        <xsl:value-of select="format-number(number($slotStartTime) + floor($slotDuration div 60), '00')"/>:<xsl:value-of select="$slotStartMinutes"/>
      </td>
      <td>
        <xsl:value-of select="author/firstname"/>
        <xsl:text> </xsl:text>
        <xsl:value-of select="author/lastname"/>
      </td>
    </tr>
  </xsl:for-each>
  
  <!-- Report des soutenances pour le lendemain si nécessaire -->
  <xsl:if test="$numRemainingStudents &gt; $numStudentsPerDay">
    <xsl:call-template name="generateSlots">
      <xsl:with-param name="students" select="$students[position() &gt; $numStudentsPerDay]"/>
      <xsl:with-param name="year" select="$year"/>
    </xsl:call-template>
  </xsl:if>
</xsl:template>

</xsl:stylesheet>
