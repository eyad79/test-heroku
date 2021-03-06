<?php

namespace Controller;  

class BaseController extends Controller
{
    
    public function accueil(){
        
       // 1 : Si besoin d'infos de la BDD... on demande à notre model ($this -> getModel()) les infos. 
        $avis           = $this -> getModel() -> getAllAvis();
        //$lienYoutube    = $this -> getModel() -> getLienYoutube();
        
        // $lienYoutube = '';
        
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //     $lien = $_POST['lien']; 

        //     $lienYoutube    = $this -> getModel() -> getLienYoutube();
        //     var_dump($lienYoutube);

        // }

        
       // Retourner la vue. 
        
        $params= array(
            'title'         => 'Accueil',
            'avis'          => $avis , 
            // 'lienYoutube'   => $lienYoutube   
        );
        
        return $this -> render('layout.php', 'home.php', $params);
    }
    
    
    public function concept(){
        
        $params = array(
            'title' => 'Concept'   
        );
        
        return $this -> render('layout.php', 'concept.php', $params);
        
    }
    
    
    
    public function contact(){
        
        $erreur = "";
        $contact_send = "";
        
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            // $erreur = '';
                
           // $nom     = filter_var($_POST['nom'],FILTER_SANITIZE_STRING );
           // $sujet   = filter_var($_POST['sujet'],FILTER_SANITIZE_STRING );
           // $email   = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL ); 
           // $msg     = filter_var($_POST['message'],FILTER_SANITIZE_STRING );

           $nom     = htmlspecialchars($_POST['nom']);
           $sujet   = htmlspecialchars($_POST['sujet']);
           $email   = htmlspecialchars($_POST['email']);
           $msg     = htmlspecialchars($_POST['msg']);
          

            // echo $nom   . '<br>';
            // echo $sujet . '<br>';
            // echo $email . '<br>';
            // echo $msg   . '<br>';


            $formErrors = array (); 

            if (strlen($nom)<3) {
                $formErrors[] = 'User is not valid' ;
            }
            if (strlen($sujet)<3) {
                $formErrors[] = 'User is not valid' ;
            }
            if (strlen($msg)<10) {
                $formErrors[] = 'Message is not valid' ;
            }

            $headers = 'From: ' . $email . '\r\n';
            $myEmail = 'formanum.eyad@gmail.com'; 
            $subject = 'Contact Form';

            if (empty($formErrors)) {
                mail($myEmail, $subject, $msg, $headers);

                    $nom    = '';
                    $sujet    = '';
                    $email   = '';
                    $msg     = '';
                    $success = '';
            }
           
            // traitements pour vérifier le contenu des champs...
            
            $erreur .="Veuillez renseigner un email";
            
            
            // traitement pour envoyer le message
            $contact_send       = $this -> getModel() ->sendContact();
            
            
            
        }
        
        $params = array(
            'erreur'        => $erreur, 
            'title'         => 'Contact', 
            'contact_send'  => $contact_send 
        );
        
        return $this -> render('layout.php', 'contact.php', $params); 
        
        
    }
    
    
    
     public function menu(){
        
        $params = array(
            'title' => 'Menu'   
        );
        
        return $this -> render('layout.php', 'Menu.php', $params);
        
    }
    
    
     public function presse(){
        
        $params = array(
            'title' => 'Presse'   
        );
        
        return $this -> render('layout.php', 'Presse.php', $params);
        
    }
    
     public function devenir_franchise(){
        $franchaiseSend = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
            // $nomF           = filter_var($_POST['nomF'],        FILTER_SANITIZE_STRING );
            // $prenomF        = filter_var($_POST['prenomF'],     FILTER_SANITIZE_STRING );
            // $emailF         = filter_var($_POST['emailF'],      FILTER_SANITIZE_EMAIL ); 
            // $ville          = filter_var($_POST['ville'],       FILTER_SANITIZE_STRING );
            // $nomSociete     = filter_var($_POST['nomSociete'],  FILTER_SANITIZE_STRING );
            // $local          = filter_var($_POST['local'],       FILTER_SANITIZE_STRING );
            // $msgF           = filter_var($_POST['messageF'],    FILTER_SANITIZE_STRING );

           $nomF            = htmlspecialchars($_POST['nomF']);
           $prenomF         = htmlspecialchars($_POST['prenomF']);
           $emailF          = htmlspecialchars($_POST['emailF']);
           $ville           = htmlspecialchars($_POST['ville']);
           $nomSociete      = htmlspecialchars($_POST['nomSociete']);
           $local           = htmlspecialchars($_POST['local']);
           $msgF            = htmlspecialchars($_POST['msgF']);
        

            // traitements pour vérifier le contenu des champs...


            $formErrors = array (); 

            if (strlen($nomF)<3) {
                $formErrors[] = 'Nom is not valid' ;
            }
            if (strlen($prenomF)<3) {
                $formErrors[] = 'Prenom is not valid' ;
            }
            if (strlen($ville)<3) {
                $formErrors[] = 'Ville is not valid' ;
            }
            if (strlen($nomSociete)<3) {
                $formErrors[] = 'Nom Societe is not valid' ;
            }
            if (strlen($msgF)<10) {
                $formErrors[] = 'Message is not valid' ;
            }

            $headers = 'From: ' . $emailF . '\r\n';
            $myEmail = 'formanum.eyad@gmail.com'; 
            $subject = 'Contact Form';

            if (empty($formErrors)) {
                mail($myEmail, $subject, $msgF, $headers);

                    $nomF    = '';
                    $prenomF    = '';
                    $emailF   = '';
                    $ville    = '';
                    $nomSociete    = '';
                    $local    = '';
                    $msgF     = '';
                    $success = '';
            }
           
            
            
            // $erreur .="Veuillez renseigner un email";
           
            
            // traitement pour envoyer le message
            $franchaiseSend       = $this -> getModel() ->sendFranchaise();
         }    
        
        $params = array(
            'title'             => 'devenir_franchise' , 
            'franchaiseSend'    => $franchaiseSend  
        );
        
        return $this -> render('layout.php', 'devenir_franchise.php', $params);
        
    }
    
    
    public function reserver(){
        $reserverSend  = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
            // $nomR           = filter_var($_POST['nomR'],        FILTER_SANITIZE_STRING );
            // $prenomR        = filter_var($_POST['prenomR'],     FILTER_SANITIZE_STRING );
            // $cell           = filter_var($_POST['cell'],        FILTER_SANITIZE_NUMBER_INT );
            // $msgR           = filter_var($_POST['messageR'],    FILTER_SANITIZE_STRING );

            $nomR            = htmlspecialchars($_POST['nomR']);
            $prenomR         = htmlspecialchars($_POST['prenomR']);
            $cell            = htmlspecialchars($_POST['cell']);
            $msgR            = htmlspecialchars($_POST['msgR']);

            // traitements pour vérifier le contenu des champs...


            $formErrors = array (); 

            if (strlen($nomR)<3) {
                $formErrors[] = 'Nom is not valid' ;
            }
            if (strlen($prenomR)<3) {
                $formErrors[] = 'Prenom is not valid' ;
            }
            
            if (strlen($msgR)<10) {
                $formErrors[] = 'Message is not valid' ;
            }

            $headers = 'From: ' . '\r\n';
            $myEmail = 'formanum.eyad@gmail.com'; 
            $subject = 'Contact Form';

            if (empty($formErrors)) 
            {
                mail($myEmail, $subject, $msgR, $headers);

                    $nomR           = '';
                    $prenomR        = '';
                    $cell           = '';
                    $date           = '';
                    $no_perssonne   = '';
                    $heure          = '';
                    $msgR           = '';
                    $success        = '';
            }
           
            
            
            // $erreur .="Veuillez renseigner un email";
           
            
            // traitement pour envoyer le message
            $reserverSend       = $this -> getModel() ->sendReserver();
            header("Refresh:0");  

         }


        $params = array(
            'title'         => 'reserver' , 
            'reserverSend'  => $reserverSend   
        );
        
        return $this -> render('layout.php', 'reserver.php', $params);
        
    }



    // Administrateur 

    public function admin()
    {
        $userget = '';
         if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {

            $username   = htmlspecialchars($_POST['username']); 
            $password   = htmlspecialchars($_POST['password']);
            $hashedPass = sha1($password); 
            $count      = '';

        // echo $username . ' '  . $passowrd . ' ' . $hashedPass ;

            $userget    = $this -> getModel() ->admin();



            // if ($count > 0) 
            // {
            //     echo 'Welcome' . ' ' . $username; 
            //     $_SESSION['username'] = $username;
            //     header('Location: dashboard.php');
            //     exit();
            // }

            // $params= array(
            //     'title' => 'admin',
                    
            // );

            // return $this -> dashboard();
        } 
       // Retourner la vue. 
        
        $params= array(
                'title' => 'admin',
                    
            );
        // $params= array(
        //     'title' => 'admin',
                
        // );
        
        return $this -> render('layout.php', 'admin.php', $params);

    }
    

     public function dashboard(){

        // 1 : Si besoin d'infos de la BDD... on demande à notre model ($this -> getModel()) les infos. 
        $avisDashboard      = $this -> getModel() -> getAllAvisDashboard();
        $reserverDAshboard  = $this -> getModel() -> getReserver();
        
        $avisStatus         = '';
        $avisDelet          = '';
        $deletReservation   = '';
        $addLienYoutube     = '';

         if ($_SERVER['REQUEST_METHOD'] == 'POST') 
         {

            // $id_avis    = filter_var($_POST['id_avis'],  FILTER_SANITIZE_NUMBER_INT );
            // $status     = filter_var($_POST['status'],   FILTER_SANITIZE_NUMBER_INT );

            $id_avis   = htmlspecialchars($_POST['id_avis']); 
            $status   = htmlspecialchars($_POST['status']); 
            

            $formErrors = array (); 

            if (strlen($id_avis)<0)
             {
                 $formErrors[] = 'id is not valid' ;
             }

            if (strlen($status)>1)            
            {

                $formErrors[] = 'status is not valid' ;
            }

            $avisStatus     = $this -> getModel() -> changeStatus();

        
        
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
         {

            $id_avis_delet    = htmlspecialchars($_POST['id_avis_delet']);

            $formErrors = array (); 

            if (strlen($id_avis_delet)<0)
             {
                 $formErrors[] = 'id is not valid' ;
             }


            $avisDelet     = $this -> getModel() -> deletAvis();
        
        }else {
            echo 'erreur';
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
         {

            $id_reserver_delet    = htmlspecialchars($_POST['id_reserver']);

            $formErrors = array (); 

            if (strlen($id_reserver_delet)<0)
             {
                 $formErrors[] = 'id is not valid' ;
             }


            $avisDelet     = $this -> getModel() -> deletReservation();
        
        }else {
            echo 'erreur';
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nom        = htmlspecialchars($_POST['nom']);

            $addLienYoutube   = $this -> getModel() -> sendLienYoutube();

         }



 
       // Retourner la vue. 
        
        $params= array(
            'title'             => 'dashboard',
            'avisDashboard'     => $avisDashboard, 
            'avisStatus'        => $avisStatus, 
            'avisDelet'         => $avisDelet , 
            'reserverDAshboard' => $reserverDAshboard, 
            'deletReservation'  => $deletReservation, 
            'addLienYoutube'    => $addLienYoutube
                
        );
        
        return $this -> render('layout.php', 'dashboard.php', $params);
    }

     public function logout(){
        
       // Retourner la vue. 
        
        $params= array(
            'title' => 'logout',
                
        );
        
        return $this -> render('layout.php', 'logout.php', $params);
    }




     public function addAvis(){
        
       // 1 : Si besoin d'infos de la BDD... on demande à notre model ($this -> getModel()) les infos. 
        $sendAvis = '';
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $note       = htmlspecialchars($_POST['note']);
            $nom        = htmlspecialchars($_POST['nom']);
            $date_avis  = htmlspecialchars($_POST['date_avis']); 
            $content    = htmlspecialchars($_POST['content']);

            $formErrors = array (); 

            if (strlen($nom)<3) {
                $formErrors[] = 'User is not valid' ;
            }
            if (strlen($content)<10) {
                $formErrors[] = 'Message is not valid' ;
            }

            $sendAvis       = $this -> getModel() -> sendAvis();

         }
       // Retourner la vue. 
        
        $params= array(
            'title' => 'addAvis',
            'sendAvis'  => $sendAvis    
        );
        
        return $this -> render('layout.php', 'addAvis.php', $params);
    }

     public function mentionsLegales(){
        
        $params = array(
            'title' => 'mentionsLegales'   
        );
        
        return $this -> render('layout.php', 'mentionsLegales.php', $params);
        
    }
    
   

    
    
    
    
}