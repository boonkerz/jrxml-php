<?php

namespace JasperReport\Component;

use JasperReport\JasperReport;

class TextField extends Component
{

	private $expression;

	function __construct( JasperReport $report, \DOMNode $node )
	{
		parent::__construct( $report, $node );

		$that = $this;

		// Text Element
		$this->jasperReport->processSingleElement( "jr:textElement", function ( $node ) use ( $that ) {
			$that->textElement = $that->jasperReport->getAttributes( $node );

			// Font
			$that->jasperReport->processElements( "jr:font", function ( $node ) use ( $that ) {
				$that->font = $that->jasperReport->getAttributes( $node );
			}, $node );

		}, $this->node, false);

		// Text field expression
		$this->jasperReport->processSingleElement( "jr:textFieldExpression", function ( $node ) use ( $that ) {
			$that->expression = $node->textContent;
		}, $this->node );
	}

	function eachDrawable( Callable $callback, \JasperReport\DataBag $dataBag )
	{
		if ( ! $this->getPrintWhen( $dataBag ) )
			return;

		$drawable = $this->getDrawableBase();

		if ( isset( $this->style ) )
		{
			$drawable->updateStyle( $this->style );
		}

		// text styles
		if ( isset( $this->font->isBold ) )
			$drawable->textStyle->bold = ( $this->font->isBold == 'true' ) ? true : false;

		if ( isset( $this->font->size ) )
			$drawable->textStyle->size = intval( $this->font->size );

		if ( isset( $this->textElement->textAlignment ) )
			$drawable->textAlign =  $this->textElement->textAlignment;

		if ( isset( $this->textElement->verticalAlignment ) )
			$drawable->verticalAlign = $this->textElement->verticalAlignment;


		$drawable->text = $this->evalString(
			$this->expression, $dataBag
		);
		call_user_func( $callback, $drawable );
	}

}