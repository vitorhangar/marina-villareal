<?php

class CTR_Bedroom {

    public function getBedroom(){

        $args = array(
            'post_type' => 'bedroom',
            'posts_per_page' => -1 
          );
          
        $query  = new WP_Query( $args );

        $query->posts = $this->getMetaDataBedroom( $query->posts );
    
        return $query;
    }

    public function getMetaDataBedroom($posts){

        

        foreach ( $posts as $post ) {
            
            $post->title = $post->post_title;

            $post->qty_couple_bed = get_post_meta($post->ID ,"couple_bed", "true");
            $post->qty_single_bed = get_post_meta($post->ID ,"single_bed", "true");

            $id_gallery = get_post_meta($post->ID ,"bedroom_images", "true");
            $id_gallery_images = explode(",",$id_gallery);

            $post->gallery_images = array();

            for($i = 0; $i < count($id_gallery_images); $i++ ) {
                
                $post->gallery_images[$i] = ImageFactory::create( $id_gallery_images[$i] , 300 , 300, true);                
            }

            $terms = wp_get_post_terms($post->ID, 'bedroom');

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {

                $id_gallery_atribute = array();
                $i = 0;

                foreach( $terms as $term ) {

                    $id_image = get_term_meta($term->term_id ,"atribute_image", "true");
          
                    $id_gallery_atribute[$i] = array(
                      'name'  => $term->name,
                      'image' => ImageFactory::create( $id_image, 300 , 300, true),
                    );
                    
                    $i++;       
                }
          
                $post->atributes = $id_gallery_atribute; 
            }
        }

        return $posts;
    }
}