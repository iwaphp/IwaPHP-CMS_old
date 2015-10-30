<?php

$body .=  '<fieldset><legend>Signalement d\'erreurs</legend>Exp&eacute;diteur :  <em>'.recuperer('nom_expediteur').' &lt;'.recuperer('email_admin').'&gt;</em> ( <a href="'.$index->targetfile.'=admin&onglet=general&admin=param_email">Modifier</a> )<br>
Pour : <strong>admin@iwaphp.org</strong><br>
Objet : <strong>Rapport de dysfonctionnement</strong> <br>

<form name="form1" method="post" action="">
  <textarea name="textarea" cols="60" rows="15"></textarea>
  <br>
  <br>
  <input type="submit" name="Submit" value="Envoyer">
</form>';

?>
