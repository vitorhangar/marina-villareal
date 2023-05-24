<?php

if( !defined( 'WPINC' ) )
  die();

class CTR_Posts
{

    // -----------------------------------------------------------------------------

    function __construct() {

        add_action( 'rest_api_init', array( $this, 'post_list'));
        add_action( 'rest_api_init', array( $this, 'search_list'));
        add_action( 'rest_api_init', array( $this, 'vaga_list'));
        add_action( 'rest_api_init', array( $this, 'vaga_quantity'));
        $this->widthCoverImage             = 650;
        $this->heightCoverImage            = 330;
        $this->coverCrop                   = false;
        $this->numberCharactersAutoExcerpt = 100;
    }
    
    // -----------------------------------------------------------------------------

    public function callback_get_vaga_quantity(){
        $vagas_quantity = wp_count_posts('vaga')->publish;

        return $vagas_quantity;
    }

    // -----------------------------------------------------------------------------

    public function callback_get_vagas($request){
        $number = isset($request->get_params()['q']) ? $request->get_params()['q'] : 8;
        $page = isset($request->get_params()['page']) ? $request->get_params()['page'] : 1;
        $posts = $this->getPosts('vaga', $number, $page);

        $vagas = array();

        foreach($posts as $post){
            $vaga = array(
                'id' => $post->ID,
                'link' => get_permalink($post->ID),
                'title' => $post->post_title,
                'cidade' => $post->cidade_vaga,
                'tipo' => $post->tipo_vaga,
            );

            array_push($vagas, $vaga);
        }

        return $vagas;
    }

    // -----------------------------------------------------------------------------

    public function getPosts($post_type = 'post', $quantity = null, $page = 1){
        $args = array( 'post_type' => $post_type,
                       'posts_per_page' => $quantity,
                       'paged' => $page,
                       'post_status' => 'publish',
        );
    
        $allPostQuery = new WP_Query($args);

        
        return $allPostQuery->posts;
    }

    // -----------------------------------------------------------------------------

    public function vaga_quantity() {
        register_rest_route( 'get/v1', '/vaga_quantity', array(
            'methods' => 'GET',
            'callback' => array( $this, 'callback_get_vaga_quantity' )
        ));
    }

    // -----------------------------------------------------------------------------

    public function vaga_list() {
        register_rest_route( 'get/v1', '/vaga_list', array(
            'methods' => 'GET',
            'callback' => array( $this, 'callback_get_vagas' )
        ));
    }

    // -----------------------------------------------------------------------------

    public function post_list() {
        register_rest_route( 'get/v1', '/post_list', array(
            'methods' => 'GET',
            'callback' => array( $this, 'callback_get_posts' )
        ));
    }

    // -----------------------------------------------------------------------------

    public function search_list() {
        register_rest_route( 'get/v1', '/search_list', array(
            'methods' => 'GET',
            'callback' => array( $this, 'callback_get_search_posts' )
        ));
    }

    // -----------------------------------------------------------------------------


    public function callback_get_posts($request){
        $number = isset($request->get_params()['q']) ? $request->get_params()['q'] : 3;
        $page = isset($request->get_params()['page']) ? $request->get_params()['page'] : 1;
        $category = isset($request->get_params()['category']) ? $request->get_params()['category'] : '';
        $search = isset($request->get_params()['search']) ? $request->get_params()['search'] : '';
        $posts = $this->getPostsBlog($number, $page, $category, $search);
        $blogPosts = array(
            'items' => array(),
            'posts_quantity' => $this->getPostsQuantity($category, $search),
        );

        foreach($posts as $post){
            $category = '';
            if(get_the_category($post->ID)[0]->name!='Não categorizado' && get_the_category($post->ID)[0]->name!='' && get_the_category($post->ID)[0]->name!='Uncategorized'){
                $category = get_the_category($post->ID)[0]->name;
            }else if(get_the_category($post->ID)[0]->name=='' && get_the_category($post->ID)[1]->name!=''){
                $category = get_the_category($post->ID)[1]->name;
            }
            
            $blogPosts['items'][] =
             array(
                'id' => $post->ID,
                'date' => $post->post_date,
                'title' => $post->post_title,
                'content' => $post->post_content,
                'category' => $category,
                'permalink' => get_permalink($post->ID),
                'image_url' => wp_get_attachment_url(get_post_thumbnail_id($post->ID))
            );
        }

        return $blogPosts;
    }

    public function callback_get_search_posts($request){
        $number = isset($request->get_params()['q']) ? $request->get_params()['q'] : 3;
        $page = isset($request->get_params()['page']) ? $request->get_params()['page'] : 1;
        $search = isset($request->get_params()['s']) ? $request->get_params()['s'] : '';
        $posts = $this->getPostsSearch($number, $page, $search);

        $searchPosts = array(
            'items' => array(),
            'posts_quantity' => $this->getPostsQuantitySearch($search),
        );


        foreach($posts as $post){
            $category = '';

            if(get_the_category($post->ID)[0]->name!='Não categorizado' && get_the_category($post->ID)[0]->name!='' && get_the_category($post->ID)[0]->name!='Uncategorized'){
                $category = get_the_category($post->ID)[0]->name;
            }else if(get_the_category($post->ID)[0]->name=='' && get_the_category($post->ID)[1]->name!=''){
                $category = get_the_category($post->ID)[1]->name;
            }
            
            $searchPosts['items'][] =
             array(
                'id' => $post->ID,
                'date' => $post->post_date,
                'title' => $post->post_title,
                'content' => $post->post_content,
                'category' => $category,
                'permalink' => get_permalink($post->ID),
                'image_url' => wp_get_attachment_url(get_post_thumbnail_id($post->ID))
            );
        }

        return $searchPosts;
    }

    // -----------------------------------------------------------------------------

    public function getPagesQuantitySearch($search){
        $args = array(  'post_type' => 'any',
                        //'s' => $search
                    );

        $allPostQuery = new WP_Query($args);

        return $allPostQuery->found_posts;
    }

    // -----------------------------------------------------------------------------

    public function getPagesQuantity(){
        $args = array('post_type' => 'post');

        $allPostQuery = new WP_Query($args);

        return $allPostQuery->found_posts;
    }

    // -----------------------------------------------------------------------------

    public function getPostsQuantitySearch($search = ''){
        $args = array('post_type' => 'any',
                      //'s' => $search,
        );    
        $allPostQuery = new WP_Query($args);
        return $allPostQuery->post_count;
    }

    // -----------------------------------------------------------------------------

    public function getPostsQuantity($category = '', $search = ''){
        $args = array('post_type' => 'post',
                      's' => $search,
                      'category_name' => $category,
        );    
        
        $allPostQuery = new WP_Query($args);
        return $allPostQuery->post_count;
    }
    
    // -----------------------------------------------------------------------------

    public function getSolutions(){
        $args = array(
            'post_type' => 'page',
            'post_parent' => 85,
        );    
        
        $allPostQuery = new WP_Query($args);
        return $allPostQuery->posts;
    }


    // -----------------------------------------------------------------------------

    public function getPostsSearch($quantity = 3, $page = 1, $search = ''){
        $args = array('post_type' => 'any',
                      'posts_per_page' => $quantity,
                      'paged' => $page,
                      'orderby' => 'post_type',
                      //'s' => $search,
        );    
        
        $allPostQuery = new WP_Query($args);

        return $allPostQuery->posts;
    }

    // -----------------------------------------------------------------------------

    public function getPostsBlog($quantity = null, $page = 1, $category = '', $search = ''){
        $args = array('post_type' => 'post',
                      'posts_per_page' => $quantity,
                      'paged' => $page,
                      's' => $search,
                      'category_name' => $category,
        );    
        
        $allPostQuery = new WP_Query($args);

        return $allPostQuery->posts;
    }

    // -----------------------------------------------------------------------------

    public function getPostsFromHome()
    {
        global $wp_query;

        $args = array(
        'post_type'      => 'post',
        'paged'          => ( isset( $wp_query->query['paged'] ) ) ? $wp_query->query['paged'] : 1,
        'posts_per_page' => get_option('posts_per_page')
        );

        //Adds nextpage to make SEO rel=next AND rel=prev work
        $query                        = new WP_Query( $args );
        $wp_query->post->post_content .='<!--nextpage-->' . $query->max_num_pages;

        $query->posts  = $this->getMetaData( $query->posts );
        return $query;

    }

    // -----------------------------------------------------------------------------

    public function getMostRecentPosts( $numberOfPosts = 3 )
    {

        $args = array(
          'post_type'      => 'post',
          'paged'          => 1,
          'posts_per_page' => $numberOfPosts,
          'orderby'        => 'post_date',
          'order'          => 'DESC',
        );

        $query         = new WP_Query( $args );
        $query->posts  = $this->getMetaData( $query->posts );
        return $query;
    }


    // -----------------------------------------------------------------------------

    public function getPostsFromRegularQuery()
    {
        global $wp_query;

        if ( isset($wp_query->query['s'] ) && $wp_query->query['s'] ) {
            $args              = $wp_query->query;
            $args['post_type'] = 'post';
            $wp_query          = new WP_Query( $args );
        }


        $wp_query->posts  = $this->getMetaData( $wp_query->posts );
        return $wp_query;
    }

    // -----------------------------------------------------------------------------


    public function getMetaData( $posts ) {

        foreach ( $posts as $post ) {
            $this->getMetaDataFromPost( $post );
        }

        return $posts;
    }

    // -----------------------------------------------------------------------------

    public function getPrivacySecurity(){

        $post = get_post(281);
        
        $info = new stdClass();

        $info->title = $post->post_title;
        $info->content = $post->post_content;

        return $info;
    }

    // -----------------------------------------------------------------------------

    public function getGeneralUseTerms(){

        $post = get_post(279);
        
        $info = new stdClass();

        $info->title = $post->post_title;
        $info->content = $post->post_content;

        return $info;
    }

    // -----------------------------------------------------------------------------

    public function getBranches() {
        $args = array('post_type' => 'branch',
                      'order' => 'ASC',
        );    
        
        $allPostQuery = new WP_Query($args);
        return $allPostQuery->posts;
    }

    // -----------------------------------------------------------------------------

    public function getMetaDataFromPost( $post ) {

        $post                  = $this->getAuthorDataFromPost( $post ) ;
        $post->permalink       = get_permalink( $post->ID );
        $post->comments_number = get_comments_number( $post->ID );
        $post->cover           = $this->getCoverFromPost( $post );
        $post->post_excerpt    = $this->getExcerptFromPost( $post );
        return $post;
    }

    // -----------------------------------------------------------------------------

    public function getAuthorDataFromPost( $post ) {

        $post->authorName = get_the_author_meta( 'display_name',  $post->post_author );
        $post->authorLink = get_author_posts_url( $post->post_author );
        $postTerms        = wp_get_object_terms($post->ID, "category");
        $post->category   = array_shift( $postTerms  );


        return $post;
    }

    // -----------------------------------------------------------------------------

    public function getCoverFromPost( $post ) {

        $thumbnailID  = get_post_thumbnail_id ( $post->ID );

        if ( $thumbnailID  == '' ||  !$thumbnailID  )
            return false;

        $newImage = ImageFactory::create( $thumbnailID , $this->widthCoverImage , $this->heightCoverImage, $this->coverCrop );

        if (  ! $newImage->imageThumbnail )
             $newImage->imageThumbnail = $newImage->imageSrc;

        return $newImage;
    }

    // -----------------------------------------------------------------------------

    public function getExcerptFromPost( $post ) {

        //Retrieve the post content.
        $text          = apply_filters('the_content', strip_shortcodes( $post->post_content ) );
        $text          = str_replace(']]&gt;', ']]&gt;', $text);
        $excerptLength = apply_filters('excerpt_length', $this->numberCharactersAutoExcerpt);

        $words = preg_split("/[\n\r\t ]+/", $text, $excerptLength + 1, PREG_SPLIT_NO_EMPTY);

        if ( count($words) && $excerptLength ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . '...';
            $text = force_balance_tags( $text );

        } else {
            $text = implode(' ', $words);
        }

        return $text;
    }

    // -----------------------------------------------------------------------------

    public function getRelated($id){

        $related = get_posts( 

            array( 
                'category__in' => wp_get_post_categories($id), 
                'numberposts' => 5, 
                'post__not_in' => array($id) 
            ) 
        );

        return $related;
    }

    // -----------------------------------------------------------------------------
}


new CTR_Posts;