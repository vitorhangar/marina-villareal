<?php

if( !defined( 'WPINC' ) )
  die();


/*
 Controller Product Admin
 */
class CTR_Product_Admin  {

    // -----------------------------------------------------------------------------

    function __construct() {
        /*add_filter( 'product_type_selector' , array( &$this, 'filterProductType' ) );
        add_filter( 'woocommerce_product_data_tabs' ,  array( &$this, 'addGalleryTab' ) );
        add_filter( 'woocommerce_product_options_general_product_data', array( &$this, 'showGalleryPerColor' ) );
        add_action( 'save_post_product' , array( &$this, 'saveGalleryPerColor' ) );
        add_action( 'save_post_product' , array( &$this, 'confirmRequiredFields' ), 90 );
        add_filter( 'post_updated_messages', array( &$this, 'updateStockVariationBasedOnAttributes' ) );
        */
    }

    // -----------------------------------------------------------------------------

    private function isAutoSavingProduct( $postId ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return true;
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ){
            if ( !current_user_can( 'edit_page', $postId ) )
                return true;
        }

        if ( !current_user_can( 'edit_post', $postId ) )
            return true;

        return false;
    }


    // -----------------------------------------------------------------------------

    public function filterProductType( $productTypes ) {

        foreach( $productTypes as $key => $productType ) {
            if ( $key != 'variable' && $key != 'simple' )
                unset( $productTypes[ $key ] );
        }

        return $productTypes;
    }

    // -----------------------------------------------------------------------------

    public function addGalleryTab( $productTabs ) {
        $productTabs[ 'colors' ] = array(
            'label'    => 'Galerias',
            'target'   => 'images_product_data',
            'class'    => array('colors'),
        );
        return $productTabs;
    }

    // -----------------------------------------------------------------------------

    public function showGalleryPerColor() {
        global $post;
        $html             = '</div><div id="images_product_data" class="panel woocommerce_options_panel">';
        $available_colors =  wp_get_post_terms( $post->ID,  Store::getTaxonomyColorName() );

        if ( ! count( $available_colors ) > 0 ) {
            $html.= '<h3>Não há variações / cores definidas.</h3>';
            echo $html;
            return ;
        }

        if ( $available_colors instanceof WP_Error  )
            return;

        foreach( $available_colors as $color ) {
            $current = get_post_meta( $post->ID , 'product_color_gallery_'.$color->slug  , true );
            $id      = 'product_color_gallery_' . $color->slug;
            $html    .= '<h3>Galeria ' . $color->name . '</h3>';
            $html    .= '<div class="product-variation-gallery">';
            $html    .= '<div class="odin-gallery-container ">';
            $html    .= '<ul class="odin-gallery-images">';
            if ( ! empty( $current ) )
            $html    .= $this->getImagesFromGalleryColor( $current );
            $html    .= '</ul><div class="clear"></div>';
            $html    .= sprintf( '<input type="hidden" class="odin-gallery-field" name="%s" value="%s" />', $id, $current );
            $html    .= sprintf( '<p class="odin-gallery-add hide-if-no-js"><a title="TROCAR" href="#">%s</a></p>', __( 'Add images in gallery', 'odin' ) );
            $html    .= '</div></div>';
        }
        echo $html;
    }

    // -----------------------------------------------------------------------------

    public function getImagesFromGalleryColor( $current ) {
        $attachments = array_filter( explode( ',', $current ) );
        if( ! $attachments )
            return '';
        $html = "";
        foreach ( $attachments as $attachment_id ) {

            $image = ImageFactory::create( $attachment_id ,150,150, 'best' );

            $html .= sprintf( '<li class="image" data-attachment_id="%1$s">%2$s<ul class="actions"><li><a title="TROCAR" href="#" class="delete" title="%3$s">X</a></li></ul></li>',
                $attachment_id,
                '<img style="height:auto;width:auto;" width="'. $image->widthResize  .'" height="'. $image->heightResize  . '" src="'. $image->imageThumbnail .'" class="attachment-32x32" >',
                __( 'Remove image', 'odin' )
            );
        }
        return $html;
    }


    // -----------------------------------------------------------------------------

    public function saveGalleryPerColor( $postId ) {

        if ( isset($_POST['tax_input'])) {

            $categories          = wp_get_object_terms( $_POST['ID'], "product_cat");
            $category            = array_shift($categories);

            if ( $category )
                delete_transient('filters_'. $category->slug );
        }

        if( $this->isAutoSavingProduct( $postId ) )
            return ;

        $available_colors =  wp_get_post_terms( $postId , Store::getTaxonomyColorName() );
        if ( ! count( $available_colors ) > 0  )
            return ;

        if ( $available_colors instanceof WP_Error  )
            return;

        foreach( $available_colors as $color ){
            if( ! isset( $_POST[ 'product_color_gallery_'.$color->slug ] ) )
                continue;

            if( $_POST[ 'product_color_gallery_'.$color->slug ] != '' ){
                update_post_meta( $postId, 'product_color_gallery_' . $color->slug , sanitize_text_field( $_POST[ 'product_color_gallery_'.$color->slug ] ) );
            }
            else{
                update_post_meta( $postId, 'product_color_gallery_' . $color->slug , '' );
            }
        }
    }

    // -----------------------------------------------------------------------------

    public function confirmRequiredFields( $postID ) {
        if( $this->isAutoSavingProduct( $postID ) )
            return ;
        if ( isset($_POST['product-type']) && $_POST['product-type']  != 'variable' )
            return ;

        $this->setDefaultVariation();
    }

    // -----------------------------------------------------------------------------

    public function updateStockVariationBasedOnAttributes( ) {
        global $post;
        if ( $post->post_type != "product" )
            return false;

        $postId = $post->ID;

        $this->resetStockBasedOnAttribute( $postId, Store::getTaxonomyColorName() );

        $parentProduct          = get_product( $postId );
        $postsProductVariations = $this->getProductVariations( $postId );
        $stockOfColors          = array();
        $stockOfSizes           = array();

        foreach( $postsProductVariations as $postProductVariation ) {
            $productVariation = get_product( $postProductVariation->ID );

            if ( $this->getIfHasStockOfProductVariationBasedOnTaxonomy( $productVariation , Store::getTaxonomyColorName() ) ){
                if ( isset( $stockOfColors[ $productVariation->variation_data['attribute_'. Store::getTaxonomyColorName() ] ] ) )
                    $stockOfColors[ $productVariation->variation_data['attribute_'. Store::getTaxonomyColorName() ] ]++;
                else
                    $stockOfColors[ $productVariation->variation_data['attribute_'. Store::getTaxonomyColorName() ] ] = 1 ;
            }
        }

        $this->updatePostMetaStockOfParentProduct( $postId , $stockOfColors);
    }

    // -----------------------------------------------------------------------------

    public function resetStockBasedOnAttribute( $postId, $taxonomy ) {
        $terms = get_terms( $taxonomy ,  array( 'hide_empty' => 0 ) );

        if ( $terms instanceof WP_Error  )
            return;

        foreach( $terms as $k  => $term )
            update_post_meta( $postId, 'stock_'. $term->slug , 0 );
    }

    // -----------------------------------------------------------------------------


    public function getProductVariations( $postId ) {
         $args = array(
            'post_type'      => 'product_variation',
            'posts_per_page' => -1,
            'post_parent'    => $postId,
        );
        return  get_posts( $args );
    }


    // -----------------------------------------------------------------------------

    public function getIfHasStockOfProductVariationBasedOnTaxonomy( $productVariation, $taxonomy ) {
        if ( ! isset( $productVariation->variation_data['attribute_'. $taxonomy ] ) )
            return ;
        if ( $productVariation->stock  > 0 )
            return true;
        else
            return false;
    }

    // -----------------------------------------------------------------------------

    public function updatePostMetaStockOfParentProduct( $productId, $stocksOfAttributes ) {
        foreach( $stocksOfAttributes as $attributeValue => $stock ) {
            update_post_meta( $productId,  'stock_' . $attributeValue , $stock );
        }
    }

    // -----------------------------------------------------------------------------

    private function setDefaultVariation() {

        if ( $_POST['default_attribute_'. Store::getTaxonomySizeName() ] && $_POST['default_attribute_'. Store::getTaxonomyColorName()] )
            return;

        if ( !is_array($_POST['attribute_'.Store::getTaxonomySizeName()]) || !is_array( $_POST['attribute_'.Store::getTaxonomyColorName() ] ) )
            return ;
        $defaultAttributes = array(
            Store::getTaxonomySizeName()   =>   $_POST['attribute_'.Store::getTaxonomySizeName()][0],
            Store::getTaxonomyColorName()  =>   $_POST['attribute_'.Store::getTaxonomyColorName()][0]

        );

        update_post_meta( $_POST['post_ID'], '_default_attributes' ,$defaultAttributes );

    }


    // -----------------------------------------------------------------------------
}
new CTR_Product_Admin();