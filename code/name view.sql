CREATE VIEW name AS
SELECT
    nameid AS ID,
    canonicalname AS scientificName,
    scientificnameauthorship AS authorship,
    taxonrank AS rank,
    
    IIF(taxonrank IN ("Familia","Regnum","Regnum","Genus","Tribus","Subtribus","Ordo","Subfamilia","Classis","Subclassis","Superordo","Subordo","Division","Superspecies","Regio"), canonicalname, "") AS uninomial,
    IIF(taxonrank NOT IN ("Familia","Regnum","Regnum","Genus","Tribus","Subtribus","Ordo","Subfamilia","Classis","Subclassis","Superordo","Subordo","Division","Superspecies","Regio"), genericname,"") AS genus,
   
    specificepithet AS specificEpithet,
    infraspecificepithet AS infraspecificEpithet,
    cultivarepithet AS cultivarEpithet,    

	namepublishedinid AS referenceID,
    namepublishedinyear AS publishedInYear,
    
	nomenclaturalcode AS code,
    nameinstancetype AS status,
    
    scientificnameid AS link
    
    FROM APNInames202208303047;