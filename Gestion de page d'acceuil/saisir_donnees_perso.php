<?php
session_start();
?>

<html>
<link rel="stylesheet" type="text/css" href="style.css" />

<script type="text/javascript" language="Javascript">

<!--
function verification() {
    if (document.formulaire.pseudo.value == "") {
        alert("Veuillez entrer un pseudo svp");
        document.formulaire.pseudo.focus();
        return false;
    } else if (document.formulaire.pwd.value == "") {
        alert("Veuillez entrer un mot de passe svp");
        document.formulaire.pwd.focus();
        return false;
    } else if (document.formulaire.pwd2.value == "") {
        alert("Veuillez confirmer votre mot de passe svp");
        document.formulaire.pwd2.focus();
        return false;
    } else if (document.formulaire.pwd2.value != document.formulaire.pwd.value) {
        alert("Veuillez entrer un mot de passe identique svp");
        document.formulaire.pwd2.focus();
        return false;
    } else if (document.formulaire.mail.value == "") {
        alert("Veuillez entrer une adresse email svp");
        document.formulaire.mail.focus();
        return false;
    } else if (document.formulaire.mail.value.indexOf('@') == -1 || document.formulaire.mail.value.indexOf('.') == -1) {
        alert("Ce n'est pas une adresse mail valide");
        document.formulaire.mail.focus();
        return false;
    } else if (!document.formulaire.accord.checked) {
        alert("Veuillez accepter la diffusion de vos coordonnées svp");
        document.formulaire.accord.focus();
        return false;
    }

    return true;
}
//-->
</script>

<table width="940" border="0" align="left">

<TR>
    <TD width="150" valign="top">
        <?php include('frame_gauche.php'); ?>
    </TD>

    <TD>

        <?php

        $prenom = "";
        $nom = "";
        $pseudo2 = "";
        $pwd = "";
        $mail = "";
        $tel = "";
        $modif = "";

        if (isset($_GET['modif']) && $_GET['modif'] != 2) {
            $modif = $_GET['modif'];
        }

        ?>

        <form name="formulaire" action="<?php if ($modif == 1) {
            echo "enregistre_conducteur.php?modif=1";
        } else {
            echo "enregistre_conducteur.php";
        } ?>" method="post" onSubmit="return verification()">

            <table width="750" border="0">
                <tr>
                    <td width="240" height="24"><p><strong>Je m'identifie:</strong></p>
                    </td>
                    <td width="500">&nbsp;</td>
                </tr>
            </table>

            <table width="750" border="0">
                <tr>
                    <td width="240" height="24"><div align="right">Mon nom</div></td>
                    <td width="500"><input name="prenom" type="text" value="<?php echo $prenom; ?>"
                                           onFocus="javascript:this.value=''">
                        <input name="nom" type="text" value="<?php echo $nom; ?>" onFocus="javascript:this.value=''">
                    </td>
                </tr>
            </table>

            <table width="750" border="0">
                <tr>
                    <td width="240" height="24"><div align="right">Mon pseudo*</div></td>
                    <td width="500"><input type="text" name="pseudo" value="<?php echo $pseudo2; ?>" ></td>
                </tr>
            </table>

            <table width="750" border="0">
                <tr>
                    <td height="8"></td>
                </tr>
            </table>

            <table width="750" border="0">
                <tr>
                    <td width="240" height="24"><div align="right">Je choisis un mot de passe*</div></td>
                    <td width="500"><input type="password" name="pwd" value="<?php echo $pwd; ?>" ></td>
                </tr>
            </table>

            <table width="750" border="0">
                <tr>
                    <td width="240" height="24"><div align="right">Je confirme le mot de passe*</div></td>
                    <td width="500"><input type="password" name="pwd2" value="<?php echo $pwd; ?>"></td>
                </tr>
            </table>
            <p>&nbsp;</p>
            <p><strong>Pour me joindre:</strong></p>
            <table width="750" border="0">
                <tr>
                    <td width="240" height="24"><div align="right">Mon adresse mail*</div></td>
                    <td width="500"><input type="text" name="mail" value="<?php echo $mail; ?>"></td>
                </tr>
            </table>

            <table width="750" border="0">
                <tr>
                    <td width="240" height="24"><div align="right">Mon téléphone</div></td>
                    <td width="500"><input type="text" name="tel" value="<?php echo $tel; ?>"></td>
                </tr>
            </table>

            <p>* champs obligatoires</p>

            <BR>

            <p>
                <input name="accord" type="checkbox" value="oui" <?php if (isset($modif) && $modif != "") {
                    echo "checked";
                } ?>>
                J'accepte que mes coordonnées soient communiquées aux usagers de ce site (dans tous les cas mon adresse mail ne sera pas visible sur le site)<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ce site s'engage à ne pas communiquer vos données à toute autre personne que les utilisateurs de ce site.<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Je décharge les créateurs de ce site de toute responsabilité en cas de problème survenu lors du covoiturage.

                <br />
            </p>
            <blockquote>
                <p>
                    <input name="soumettre" type="submit" value="Valider">
                </p>
            </blockquote>
        </form>

    </TD>
</TR>

</table>


</html>
