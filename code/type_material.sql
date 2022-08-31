DROP VIEW type_material;
CREATE VIEW type_material AS
SELECT 
    nameid AS ID,
    nameid AS nameID,
    typecitation AS citation
FROM APNInames202208303047
WHERE typecitation LIKE "type:%"
AND taxonrank In ("Species", "Subspecies", "Varietas", "Forma");
