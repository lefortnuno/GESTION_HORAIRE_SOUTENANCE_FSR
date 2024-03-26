<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="text" indent="yes"/>

  <!-- Template to match the root node -->
  <xsl:template match="/">
    <xsl:text>Horaire des soutenances :</xsl:text>
    <xsl:text>&#10;</xsl:text>
    <!-- Apply templates to each student -->
    <xsl:apply-templates select="//student"/>
  </xsl:template>

  <!-- Template to match each student -->
  <xsl:template match="student">
    <xsl:text>Étudiant : </xsl:text>
    <xsl:value-of select="author/firstname"/>
    <xsl:text> </xsl:text>
    <xsl:value-of select="author/lastname"/>
    <xsl:text>&#10;Date et heure de soutenance : 2024-03-26 09:00:00&#10;Durée de présentation : 20 minutes&#10;&#10;</xsl:text>
  </xsl:template>
</xsl:stylesheet>
