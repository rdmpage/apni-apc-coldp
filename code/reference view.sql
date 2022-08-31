CREATE VIEW reference AS
SELECT 
	id AS ID,
    refType AS type,
    citation,
    author,
    title,
    containertitle AS containerTitle,
    issn,
    volume,
    edition,
    pages AS page,
    year AS issued,
    doi,
	isbn,
	"https://id.biodiversity.org.au/reference/apni/" || id AS link
FROM referencetsv;