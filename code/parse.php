<?php

$basedir = dirname(dirname(__FILE__)) . '/data/json';

$files = scandir($basedir);

// debugging
/*
$files = array('22782.json');
//$files = array('17283.json');
$files = array('23287.json');
$files = array('23811.json');
*/

$keys = array(
'id',
'refType',
'citation',
'author',
'title',
'parent_id',
'containertitle',
'issn',
'volume',
'edition',
'pages',
'year',
'publicationDate',
'doi',
'isbn',
'bhlUrl'
);

echo join("\t", $keys) . "\n";

foreach ($files as $filename)
{
	if (preg_match('/\.json$/', $filename))
	{	
		// do stuff on $basedir . '/' . $filename
		
		$id = str_replace('.json', '', $filename);
		
		$json = file_get_contents($basedir . '/' . $filename);
		
		//echo $json;
		
		$obj = json_decode($json);
		
		//print_r($obj);
		
		$export = new stdclass;
		$export->id = $id;
		
		foreach ($obj as $k => $v)
		{
			// ignore null values
			$ok = true;
			
			if ($v == "Not set")
			{
				$ok = false;
			}

			if ($v == '')
			{
				$ok = false;
			}

			if ($v == 'null - null')
			{
				$ok = false;
			}
			
			if ($ok)
			{
				switch ($k)
				{
					case 'doi':
						// clean (still more weird things to do..)
						$v = preg_replace('/([h|n]ttps?:\/\/)?(dx\.)?doi.org\//', '', $v);
						$v = preg_replace('/DOI:\s*/i', '', $v);
						$v = strtolower($v);
						
						$export->{$k} = $v;
						break;
						
					case 'title':
					case 'year':
					case 'volume':
					case 'edition':
					case 'pages':
					case 'citation':
					case 'publicationDate':
					case 'isbn':
					case 'issn':
					case 'bhlUrl':
					case 'refType':
						$export->{$k} = $v;
						break;
						
					case 'parent':
						if (isset($v->_links))
						{
							$export->parent_id = str_replace('https://id.biodiversity.org.au/reference/apni/', '', $v->_links->permalink->link);
						}
						if (isset($v->citation))
						{
							$export->containertitle = $v->citation;
						}
						break;

					case 'author':
						if (isset($v->name))
						{
							$export->{$k} = $v->name;
						}
						break;
						
					default:
						break;
				}						
			}
		
		
		
		}
		
		//print_r($export);
		
		$row = array();
		
		foreach ($keys as $k)
		{
			if (isset($export->{$k}))
			{
				$row[] = $export->{$k};
			}
			else
			{
				$row[] = "";
			}
		}
		
		echo join("\t", $row) . "\n";
	}
}



?>
