<?php

class HG_Sessions{

    public function setSession($user_id, $aulaSlug){
        global $wpdb;

        $url= get_site_url().'/watch='.$aulaSlug;

        $queryLive = "SELECT * FROM ".$wpdb->prefix."posts WHERE post_name='".$aulaSlug."'";
        $resultPost = $wpdb->get_results($queryLive);
        $liveID = $resultPost[0]->ID;

        $user = get_user_by('ID', $user_id); //Pega os dados do usuário pelo user_id

        $query = "SELECT id,user_id, cpf FROM ".$wpdb->prefix."hg_inscricoes WHERE user_id =".$user->ID;
      
        //Usa o email dele para pegar o cpf de inscrição
        $result = $wpdb->get_results($query);
        
        $cpf = $result[0]->cpf;
        $inscrito_id = $result[0]->id;

        date_default_timezone_set('America/Sao_Paulo');

        $session_data = array(
            "data" => date('Y-m-d H:i:s'),
            "user_id" => $user_id,
            "user_cpf" => $cpf,
            "inscrito_id" => $inscrito_id,
            "redirect_url" => $url,
            "live_id" => $liveID
        );

        $wpdb->insert( $wpdb->prefix."hg_sessions", $session_data);

    }
    
}