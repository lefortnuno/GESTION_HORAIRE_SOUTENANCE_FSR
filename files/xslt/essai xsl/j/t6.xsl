<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output method="html" encoding="UTF-8"/>

  <!-- Variables -->
  <xsl:variable name="soutenanceDurationMinutes" select="20"/>
  <xsl:variable name="studentsPerDay" select="9"/>

  <!-- Template to match the root element -->
  <xsl:template match="/">
    <html>
      <head>
        <title>Horaires de soutenance des étudiants</title>
      </head>
      <body>
        <h1>Horaires de soutenance des étudiants</h1>
        <xsl:apply-templates select="submission/student"/>
      </body>
    </html>
  </xsl:template>

  <!-- Template to match each student -->
  <xsl:template match="student">
    <!-- Calculate the date and time of the soutenance -->
    <xsl:variable name="dayIndex" select="position() div $studentsPerDay"/>
    <xsl:variable name="soutenanceDate" select="concat('2024-03-', string($dayIndex + 1))"/>
    <xsl:variable name="soutenanceTime">
      <xsl:call-template name="calculateTime">
        <xsl:with-param name="index" select="position() mod $studentsPerDay"/>
      </xsl:call-template>
    </xsl:variable>
    
    <!-- Display student's information -->
    <xsl:if test="$soutenanceTime != ''">
      <div>
        <h2>Code Apogee: <xsl:value-of select="author/@codeApogee"/></h2>
        <p>Nom et Prénom: <xsl:value-of select="concat(author/firstname, ' ', author/lastname)"/></p>
        <p>Thème: <xsl:value-of select="theme"/></p>
        <p>Discipline: <xsl:value-of select="disciplines"/></p>
        <p>Date de soutenance: <xsl:value-of select="$soutenanceDate"/></p>
        <p>Horaire de soutenance: <xsl:value-of select="$soutenanceTime"/></p>
      </div>
    </xsl:if>
  </xsl:template>

  <!-- Template to calculate the time of soutenance -->
  <xsl:template name="calculateTime">
    <xsl:param name="index"/>
    <xsl:variable name="minutesOffset" select="$index * $soutenanceDurationMinutes"/>
    <xsl:value-of select="concat(format-number(floor($minutesOffset div 60) + 9, '00'), ':', format-number($minutesOffset mod 60, '00'))"/>
  </xsl:template>

</xsl:stylesheet>
