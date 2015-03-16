<?php

namespace JasperReport\Component;

use JasperReport\JasperReport;

class Image extends Component
{

	private $expression;

	function __construct( JasperReport $report, \DOMNode $node )
	{
		parent::__construct( $report, $node );

		$that = $this;

		// Text field expression
		$this->jasperReport->processSingleElement( "jr:imageExpression", function ( $node ) use ( $that ) {
			$that->expression = $this->jasperReport->getReportPath() . str_replace('"', '', $node->textContent);
		}, $this->node );

	}

	function eachDrawable( Callable $callback,  \JasperReport\DataBag $dataBag )
	{
		if ( ! $this->getPrintWhen( $dataBag ) )
			return;

		$drawable = $this->getDrawableBase();
		$drawable->imageSrc = $this->expression;

		call_user_func( $callback, $drawable );
	}

}