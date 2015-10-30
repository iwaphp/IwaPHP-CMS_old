<?php
$body .= '<fieldset><legend>Configuration racine</legend><table width="100%" id=tableau border="0" cellspacing="2" cellpadding="0">
     <tr>
    <td>Nom du fichier racine : </td>
    <td><input name="textfield" type="text" value="index.php"></td>
  </tr>
  <tr>
    <td>Nom de la variable $_GET racine : </td>
    <td><input name="textfield" type="text" value="page" size="5" maxlength="4"></td>
  </tr>
  <tr>
    <td>Chemin physique : </td>
    <td><input type="text" name="textfield"></td>
  </tr>
  <tr>
    <td>Protocole : </td>
    <td><input type="radio" name="radiobutton" value="radiobutton" checked="true" disabled/>
      http://<br>
      <input type="radio" name="radiobutton" value="radiobutton" disabled/>
      https://</td>
  </tr>
  <tr>
    <td>Nom de domaine : </td>
    <td><input type="text" name="textfield"></td>
  </tr>
  <tr>
    <td>Port : </td>
    <td><input name="textfield" type="text" value="80" size="5"></td>
  </tr>
</table></fieldset><br>
<fieldset><legend>Actions</legend>
<div align="center">
  <input type="submit" name="Submit" value="Envoyer">
  <input type="reset" name="Submit" value="R&eacute;initialiser">
</div></fieldset>';
?>