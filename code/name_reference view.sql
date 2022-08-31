DROP VIEW name_reference;
CREATE VIEW name_reference AS
SELECT
    nameid,
    canonicalname,
    scientificnameauthorship,
    referencetsv.id,
    referencetsv.citation,
    referencetsv.author,
    referencetsv.title,
    referencetsv.containertitle,
    referencetsv.issn,
    referencetsv.volume,
    referencetsv.pages,
    referencetsv.year,
    referencetsv.doi,
    referencetsv.bhlurl
    FROM APNInames202208303047 
 INNER JOIN referencetsv
 ON APNInames202208303047.namepublishedinid = referencetsv.id;