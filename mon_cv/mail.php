<?php
$s = "";
function verifieEmail($mail) 
{
	if (preg_match('/^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$]/i',$mail)) return false;
	list ($nom,$domaine) = explode ('@',$mail);
	if (getmxrr($domaine,$mxhosts)) return true;
	else return false;
} 
if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['message']))
{
    $destinataire = "leo.onedrive33@gmail.com";
    $sujet = "Infos";
    $message = "Nom : ".$_POST['nom']."\r\n";
    $message .= "Prenom : ".$_POST['prenom']."\r\n";
    $message .= "Adresse email : ".$_POST['email']."\r\n";
    $message .= "Message : ".$_POST['message']."\r\n";
    $from = $_POST['email'];
    if (verifieEmail($from))
    {
        $entete = 'From: '.$from;
        if (mail($destinataire,$sujet,$message,$entete))
        {
            header('Location: https://www.google.fr'); // Redirection vers la page de confirmation
        }
        else
        {
            $s = "Une erreur s'est produite. Votre demande n'a pas été envoyée.";
        }
    }
    else
    {
        $s = "Votre email est invalide. Votre demande n'a pas été envoyée.";
    }
}
else
{
    $s = "Vous n'avez pas rempli tous les champs. Votre demande n'a pas été envoyée.";
}
if ($s) echo $s;

?>