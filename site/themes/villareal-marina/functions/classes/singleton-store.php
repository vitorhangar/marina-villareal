<?php

if( !defined( 'WPINC' ) )
  die();

/**
 *  Singleton Store
 *  @description define the attributes and methos to be used in all parts of the store
 */
class Store
{

    private $productQuery;
    private $fullProductQuery;

    public static function getInstance()
    {
        static $instance = null;

        if (null === $instance)
            $instance = new static();

        return $instance;
    }

    // -----------------------------------------------------------------------------

    protected function __construct() { }

    // -----------------------------------------------------------------------------

    private function __clone() { }

    // -----------------------------------------------------------------------------

    private function __wakeup() { }

    // -----------------------------------------------------------------------------


    public function setProductQuery( $query ) {
        $instance = self::getInstance();
        $instance->productQuery = $query;
    }

    // -----------------------------------------------------------------------------

    public function getProductQuery() {
        $instance = self::getInstance();
        return $instance->productQuery;
    }

    // -----------------------------------------------------------------------------

    public function setFullProductQuery( $query ) {

        $instance = self::getInstance();
        $instance->fullProductQuery = $query;
    }

    // -----------------------------------------------------------------------------

    public function getFullProductQuery() {
        $instance = self::getInstance();
        return $instance->fullProductQuery;
    }

    // -----------------------------------------------------------------------------

    public static function getTaxonomyColorName( ) {
        return 'pa_cor';
    }

    // -----------------------------------------------------------------------------

    public static function getTaxonomySizeName( ) {
        return 'pa_tamanho';
    }

    // -----------------------------------------------------------------------------

    public static function getMaxInstallmentsNumber( $value = "") {

        $maxInstallments     = 3;
        $minInstallmentValue = 30;

        if ( $value < $minInstallmentValue * 2)
            return 1;

        if ( $value <= $minInstallmentValue * 3 )
            return 2;
        else
            return 3;


    }

    // -----------------------------------------------------------------------------

    public function getStates() {
        return array( 'AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RO','RS','RR','SC','SE','SP', 'TO' );
    }

    // -----------------------------------------------------------------------------



}