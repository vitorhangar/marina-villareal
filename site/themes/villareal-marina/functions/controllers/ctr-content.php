<?php

class CTR_Content {

    public function getInfos(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        foreach ( $query->posts as $post ) {
            $post->adress              = get_post_meta($post->ID, 'endereco', true);
            $post->adress_link         = get_post_meta($post->ID, 'endereco_link', true);
            $post->adress_link_embed   = get_post_meta($post->ID, 'endereco_link_embed', true);
            $post->telefone            = get_post_meta($post->ID, 'telefone', true);
            $post->email               = get_post_meta($post->ID, 'email', true);
            $post->facebook            = get_post_meta($post->ID, 'facebook', true);
            $post->instagram           = get_post_meta($post->ID, 'instagram', true);
        }

        return $post;
    }

    public function getBanners(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        $info = new stdClass();

        foreach ( $query->posts as $post ) {
            $id_gallery = get_post_meta($post->ID ,"banner_images", "true");
            $id_gallery_images = explode(",",$id_gallery);

            for($i = 0; $i < count($id_gallery_images); $i++ ) {
                
                $info->gallery_images[$i] = ImageFactory::create( $id_gallery_images[$i] , 300 , 300, true);
                
            }
        }       

        return $info;
    }

    public function getAbout(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        $info = new stdClass();

        foreach ( $query->posts as $post ) {
            $info->title    = get_post_meta($post->ID, 'about_title', true);
            $info->content  = get_post_meta($post->ID, 'about_text', true);

            $id_gallery = get_post_meta($post->ID ,"about_images", "true");
            $id_gallery_images = explode(",",$id_gallery);

            for($i = 0; $i < count($id_gallery_images); $i++ ) {
                
                $info->gallery_images[$i] = ImageFactory::create( $id_gallery_images[$i] , 300 , 300, true);
                
            }
        }       

        return $info;
    }

    public function getEstrutura(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        $info = new stdClass();

        foreach ( $query->posts as $post ) {
            $info->title    = get_post_meta($post->ID, 'estrut_title', true);
            $info->content  = get_post_meta($post->ID, 'estrut_text', true);

            $id_gallery = get_post_meta($post->ID ,"estrut_images", "true");
            $id_gallery_images = explode(",",$id_gallery);

            for($i = 0; $i < count($id_gallery_images); $i++ ) {
                
                $info->gallery_images[$i] = ImageFactory::create( $id_gallery_images[$i] , 300 , 300, true);
                
            }
        }       

        return $info;
    }

    public function getDetails(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        foreach ( $query->posts as $post ) {
            $post->details_title_1   = get_post_meta($post->ID, 'details_1_title', true);
            $post->details_text_1    = get_post_meta($post->ID, 'details_1_text', true);
            $id_image_1    = get_post_meta($post->ID, 'details_1_image', true);
            $post->details_image_1 = ImageFactory::create( $id_image_1, 300 , 300, true);

            $post->details_title_2   = get_post_meta($post->ID, 'details_2_title', true);
            $post->details_text_2    = get_post_meta($post->ID, 'details_2_text', true);
            $id_image_2    = get_post_meta($post->ID, 'details_2_image', true);
            $post->details_image_2 = ImageFactory::create( $id_image_2, 300 , 300, true);
        }

        return $post;
    }

    public function getInfosPageContact(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        foreach ( $query->posts as $post ) {
            $post->title   = get_post_meta($post->ID, 'page_contato_title', true);
            $post->content    = get_post_meta($post->ID, 'page_contato_text', true);
        }

        return $post;
    }

    public function getBaia(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        $info = new stdClass();

        foreach ( $query->posts as $post ) {
            $info->title    = get_post_meta($post->ID, 'baia_title', true);
            $info->content  = get_post_meta($post->ID, 'baia_text', true);

            $id_gallery = get_post_meta($post->ID ,"baia_images", "true");
            $id_gallery_images = explode(",",$id_gallery);

            for($i = 0; $i < count($id_gallery_images); $i++ ) {
                
                $info->gallery_images[$i] = ImageFactory::create( $id_gallery_images[$i] , 300 , 300, true);
                
            }
        }       

        return $info;
    }

    public function getSegurancaa(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        $info = new stdClass();

        foreach ( $query->posts as $post ) {
            $info->title    = get_post_meta($post->ID, 'segur_title', true);
            $info->content  = get_post_meta($post->ID, 'segur_text', true);

            $id_gallery = get_post_meta($post->ID ,"segur_images", "true");
            $id_gallery_images = explode(",",$id_gallery);

            for($i = 0; $i < count($id_gallery_images); $i++ ) {
                
                $info->gallery_images[$i] = ImageFactory::create( $id_gallery_images[$i] , 300 , 300, true);
                
            }
        }       

        return $info;
    }

    public function getSeguranca(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        $info = new stdClass();

        foreach ( $query->posts as $post ) {
            $info->title    = get_post_meta($post->ID, 'seguranca_title', true);
            $info->content  = get_post_meta($post->ID, 'seguranca_text', true);

            $id_gallery = get_post_meta($post->ID ,"seguranca_images", "true");
            $id_gallery_images = explode(",",$id_gallery);

            for($i = 0; $i < count($id_gallery_images); $i++ ) {
                
                $info->gallery_images[$i] = ImageFactory::create( $id_gallery_images[$i] , 300 , 300, true);
                
            }
        }       

        return $info;
    }

    public function getFotos(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        $info = new stdClass();

        foreach ( $query->posts as $post ) {
            $info->title    = get_post_meta($post->ID, 'fotos_title', true);
            $info->content  = get_post_meta($post->ID, 'fotos_text', true);

            $id_gallery = get_post_meta($post->ID ,"fotos_images", "true");
            $id_gallery_images = explode(",",$id_gallery);

            for($i = 0; $i < count($id_gallery_images); $i++ ) {
                
                $info->gallery_images[$i] = ImageFactory::create( $id_gallery_images[$i] , 300 , 300, true);
                
            }
        }       

        return $info;
    }

    public function getPrecos(){

        $args = array(
            'post_type' => 'content',
        );
          
        $query  = new WP_Query( $args );

        $info = new stdClass();

        foreach ( $query->posts as $post ) {
            $info->title    = get_post_meta($post->ID, 'preco_title', true);
            $info->content  = get_post_meta($post->ID, 'preco_text', true);
        }       

        return $info;
    }
}