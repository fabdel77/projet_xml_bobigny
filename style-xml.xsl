<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<head>
				<title>Transformation XSLT</title>
			</head>
			<body>
				<xsl:for-each select="ficheMemoire">
					<h1>Fiche mémoire</h1>
					<xsl:apply-templates select="apprenti" />
					<xsl:apply-templates select="entreprise" />
					<xsl:apply-templates select="contenu" />
					<p><xsl:value-of select="appreciation"/></p>
					<p><xsl:value-of select="note"/></p>
				</xsl:for-each>
				
			</body>
		</html>
	</xsl:template>
	<xsl:template match="/apprenti">
		<h2>Apprenti</h2>
		<p>Numéro INE :<xsl:value-of select="INE"/></p>
		<p>Nom :<xsl:value-of select="apprenti/nom"/></p>
		<p>Prénom :<xsl:value-of select="prenom"/></p>
		<p>Formation :<xsl:value-of select="formation"/></p>
		<p>Promotion :<xsl:value-of select="promotion"/></p>
		<xsl:apply-templates select="tuteurPedago" />
		
	</xsl:template>
	<xsl:template match="tuteurPedago">
		<h2>Tuteur pédagogique</h2>
		<p>Nom :<xsl:value-of select="nom"/></p>
		<p>Prénom :<xsl:value-of select="prenom"/></p>
		<p>Fonction :<xsl:value-of select="fonction"/></p>
		<p>Mail :<xsl:value-of select="mail"/></p>
	</xsl:template>
	<xsl:template match="entreprise">
		<h2>Entreprise</h2>
		<p>Nom :<xsl:value-of select="nom"/></p>
		<p>site :<xsl:value-of select="site"/></p>
		<p>secteur :<xsl:value-of select="secteur"/></p>
		<p>adresse :<xsl:value-of select="adresse"/></p>
		<p>taille :<xsl:value-of select="taille"/> personnes</p>
		<p>description :<xsl:value-of select="description"/></p>
		<p>siret :<xsl:value-of select="siret"/></p>
		<xsl:apply-templates select="tuteurPedago" />
	</xsl:template>
	<xsl:template match="maitreApprentissage">
		<h3>Maitre d'apprentissage</h3>
		<p>Nom :<xsl:value-of select="nom"/></p>
		<p>Prénom :<xsl:value-of select="Prénom"/></p>
		<p>Fonction :<xsl:value-of select="fonction"/></p>
		<p>Mail :<xsl:value-of select="mail"/></p>
	</xsl:template>
	<xsl:template match="contenu">
		<h3><xsl:value-of select="titre"/></h3>
		<xsl:for-each select="motsClefs">
			<p><xsl:value-of select="motClef"/></p>
		</xsl:for-each>
		<p>Problematique :<xsl:value-of select="problematique"/></p>
		<xsl:for-each select="outils">
			<p><xsl:value-of select="outil"/></p>
		</xsl:for-each>
		<xsl:for-each select="technos">
			<p><xsl:value-of select="technos"/></p>
		</xsl:for-each>
		<xsl:for-each select="missions">
			<xsl:apply-templates select="mission" />
		</xsl:for-each>
	</xsl:template>
	<xsl:template match="mission">
		<p><xsl:value-of select="description"/></p>
	</xsl:template>
</xsl:stylesheet>