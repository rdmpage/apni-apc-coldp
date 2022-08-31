DROP VIEW taxa;
CREATE VIEW taxa AS
SELECT 
    taxonid AS ID,
    parentnameusageid AS parentID,
    REPLACE(scientificnameid, 'https://id.biodiversity.org.au/name/apni/', '') AS nameID,
    taxonremarks AS remarks,
    taxonid AS link
    
    FROM APCtaxon202208303350
WHERE 
nametype = "scientific"
AND taxonomicstatus == "accepted";