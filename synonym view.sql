DROP VIEW synonym;
CREATE VIEW synonym AS
SELECT 
    taxonid AS ID,
    acceptednameusageid AS taxonID,
    REPLACE(scientificnameid, 'https://id.biodiversity.org.au/name/apni/', '') AS nameID,
    nomenclaturalstatus AS namePhrase,
    REPLACE(nameaccordingtoid, 'https://id.biodiversity.org.au/reference/apni/', '') AS accordingToID,
    taxonomicstatus AS status,
    taxonremarks AS remarks,
    taxonid AS link
    
FROM APCtaxon202208303350
WHERE 
nametype = "scientific"
AND taxonomicstatus != "accepted";
