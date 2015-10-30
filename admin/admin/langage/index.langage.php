<?php
$contenu = null;
$body .='<fieldset><legend>Langue par defaut du site</legend>Liste des langues install&eacute;s :<br>
<br>
<table width="100%" id="tableau" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><strong>Nom du fichier </strong></td>
    <td><strong>Langage</strong></td>
    <td><strong>Activer</strong></td>
    <td><strong>Supprimer</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center">
      <input type="radio" name="radiobutton" value="radiobutton">
    </div></td>
    <td><div align="center">[ <a href="#">Supprimer</a> ] </div></td>
  </tr>
</table> <input type="submit" name="Submit" value="Activer"></fieldset>
<br><fieldset><legend>Installer un langage</legend>
Installer un langage :<br>
<div align="center">T&eacute;l&eacute;charger ici les fichiers de langages :<br />
			<input type="file" name="langage" size="30"><br>( fichier portant l\'extension <b>.php</b> )</div>
<br></fieldset>';
?>