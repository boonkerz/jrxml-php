<?php

namespace JasperReport\Datasource;

class ArrayDatasource implements DatasourceInterface
{

	private $rows = array();

	function __construct( $rows )
	{
		$this->rows = $rows;
	}

	function nextPage()
	{
		return;
	}

	function execQuery( $query )
	{
	}

	function getRows() {
		return $this->rows;
	}
	
}