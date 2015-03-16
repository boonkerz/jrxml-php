<?php

namespace JasperReport\Datasource;

interface DatasourceInterface
{
	
	function execQuery( $query );

	/**
	 * @return array
	 */
	function getRows();

}