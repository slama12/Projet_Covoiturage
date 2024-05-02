<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
?>

<html>

	<?php
		
	$modif=isset($_GET['modif']) ? $_GET['modif'] : '';
	
	include('connexion_SQL.php');
	
	$pseudo=isset($_POST['pseudo']) ? mysqli_real_escape_string($connexion,htmlspecialchars($_POST['pseudo'])) : '';
	$mail=isset($_POST['mail']) ? mysqli_real_escape_string($connexion,htmlspecialchars($_POST['mail'])) : '';
	$mdp=isset($_POST['mdp']) ? mysqli_real_escape_string($connexion,htmlspecialchars($_POST['mdp'])) : '';
	//$heure=mysql_real_escape_string(htmlspecialchars($_POST['heure']));
	
	$nom=mysqli_real_escape_string($connexion,htmlspecialchars($_POST['nom']));
	if ($nom == "nom") { $nom=""; }
	
	$prenom=mysqli_real_escape_string($connexion,htmlspecialchars($_POST['prenom']));
	if ($prenom == "prenom") { $prenom=""; }
	
	$tel=mysqli_real_escape_string($connexion,htmlspecialchars($_POST['tel']));
	//$coment=nl2br(mysql_real_escape_string(htmlspecialchars($_POST['coment'])));
		
	$date=date("Y-m-d");
	
	if (isset($_SESSION['loginOK']) && $_SESSION['loginOK'] == true && $modif == 1) 
	{
	$id=$_SESSION['id'];
			
	mysqli_query($connexion,"UPDATE conducteurs SET pseudo='$pseudo', mail='$mail', mdp='$mdp', nom='$nom', prenom='$prenom', tel='$tel' WHERE id_conducteur='$id' LIMIT 1") or die(mysqli_error($connexion));
	
		?>
	<table width="940" border="0" align="left" >
	<TR>
		<TD width="150" valign="top">
			<?php include('frame_gauche.php'); ?>
		</TD>

		<TD valign="top">
		
	<?php
	
	if ($_SESSION['loginOK'] == true) {
	include('menus_session.htm');
	echo "</br>";	
	}
		echo "Les modifications on bien �t� prises en compte <br /><br /><br />";
		
		echo "<a href=\"index2.php\">Retour &agrave; l'accueil</a>";
		
		echo "</TD></TR></table>";
		
	}
	

	else {
	
			
		$reponse = mysqli_query($connexion,"SELECT * FROM conducteurs WHERE pseudo='$pseudo'") or die(mysqli_error($connexion));
		
		$donnees = mysqli_fetch_array($reponse);
		
		if ($donnees== "") 
		{
		
			?>
		<table width="940" border="0" align="left" >
		<TR>
		<TD width="150" valign="top">
			<?php include('frame_gauche.php'); ?>
		</TD>

		<TD valign="top">
		
		<?php
						
	   	mysqli_query($connexion,"INSERT INTO conducteurs VALUES('', '$pseudo', '$mail', '$mdp', '$nom', '$prenom', '$tel')");
			
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['mail'] = $mail;
		$_SESSION['loginOK'] = true;
		
		//J'avais mis un cookie qui s'est mis � ne plus marcher...
		
		//$timestamp_expire = time() + 365*24*3600; // Le cookie expirera dans un an
		//setcookie('pseudo', $pseudo, $timestamp_expire); // On �crit un cookie
		
		$reponse = mysqli_query($connexion,"SELECT * FROM conducteurs WHERE pseudo='$pseudo'") or die(mysqli_error($connexion));
						
		while ($donnees = mysqli_fetch_array($reponse) )
			{
			$_SESSION['id'] = $donnees['id_conducteur'];
			}
		
		mysqli_close($connexion);
		
		$objet="votre inscription sur covoiturage";
		$message="Bonjour,<BR><BR>Bienvenue sur le site covoiturage.<BR><BR>Voici vos informations personelles:<BR><BR>pseudo : ".$pseudo."<BR>mot de passe : ".$mdp."<BR><BR>L'�quipe de <a href=\"http://vvcovoiturage.free.fr\">vvcovoiturage</a>";
		
		$headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
	     
		mail("$mail", "$objet", "$message", $headers);
		
		include('menus_session.htm');
		echo "</br>";
		
		echo "Votre inscription a bien &eacute;t&eacute; prise en compte, merci. Vous �tes maintenant connect&eacute;<br /><br /><br />";
		echo "Un mail vous a �t� envoy&eacute; avec vos informations personnelles.";
		echo "<BR><BR>";
		
		echo "<a href=\"index2.php\">Retour &agrave; l'accueil</a>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<a href=\"saisir_trajet.php\">Saisir un trajet</a>";
		
		echo "</TD></TR></table>";
		
		}
			
		else 
		{
		$modif = 2;
		$pseudo2 = $pseudo;
		include ('saisir_donnees_perso.php');
		echo "<script>alert(unescape('D%E9sol%E9, ce pseudo existe d%E9j� !'))</script>"; 
		
		}
		
		
		}		
		
		
		
		?>

</html>
