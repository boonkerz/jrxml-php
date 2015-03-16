<?php

namespace JasperReport\Datasource;

class MysqlDatasource implements DatasourceInterface
{

	private $db;
	private $rows = array();

	function __construct( $host, $username, $password, $database, $port )
	{

		$this->db = new \mysqli(
			$host,
			$username,
			$password,
			$database,
			$port
        );

	}

	function nextPage()
	{
		return;
	}

	function execQuery( $query )
	{
		$r = $this->db->query( $query );

		if ( $r === false )
			throw new \Exception( "Error with query" );

		while ( $row = $r->fetch_array() )
		{
			$this->rows[ count( $this->rows )] = $row;
		}
	}

	function getRows() {
		return $this->rows;
	}
	
}