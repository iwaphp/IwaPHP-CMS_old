<?php

class Form
{	

	function UpdateBdd ($variablePost, $enregistrerDansLeChamp, $dansLaTable)
	{
		global $db;
		$db->sql_query("UPDATE ".$db->prefix_tables.$dansLaTable." SET ".$enregistrerDansLeChamp."='".$variablePost."' WHERE id='1'");
	}
	
	
	
	// OUTILS DE FORMULAIRES
	# exemple : BooleanRadioButton ('Activer bidule ?',  'activer_bidule', 'oui', 'non');
	function BooleanRadioButton ($caption, $nomRadioBouton, $captionTrue, $captionFalse)
	{
		global $contenu;
		if (recuperer($nomRadioBouton) == 'oui')
		{
			$contenu = '<tr><td>'.$caption.' : </td><td><input type="radio" name="'.$nomRadioBouton.'" value="oui" checked>
			'.$captionTrue.'<br>
			<input type="radio" name="'.$nomRadioBouton.'" value="non">
			'.$captionFalse.'</td></tr>';
		} else {
			$contenu = '<tr><td>'.$caption.' : </td><td><input type="radio" name="'.$nomRadioBouton.'" value="oui">
			'.$captionTrue.'<br>
			<input type="radio" name="'.$nomRadioBouton.'" value="non" checked>
			'.$captionFalse.'</td></tr>';
		}
		return $contenu;
	}
	
	function SelectMemoireType ($name)
	{
		$contenu = null;
		$contenu ='<select name="'.$name.'_memoiretype">';
	  
			if (recuperer(''.$name.'_memoiretype') == 'ko')
			{
				$contenu .= '<option value="ko" selected>Ko</option>
				<option value="mo">Mo</option>
				<option value="go">Go</option>';
			}
			elseif (recuperer(''.$name.'_memoiretype') == 'mo')
			{
				$contenu .= '<option value="ko">Ko</option>
				<option value="mo" selected>Mo</option>
				<option value="go">Go</option>';
			}
			elseif (recuperer(''.$name.'_memoiretype') == 'go')
			{
				$contenu .= '<option value="ko">Ko</option>
				<option value="mo">Mo</option>
				<option value="go" selected>Go</option>';
			}
	
		$contenu .='</select>';
		return $contenu;
	}
	
	# exemple : InputText ('Nom de bidule', 'bidule_name', '15', 1)
	function InputText ($caption, $integrated, $name, $size, $inTable, $DestroyRecovery)
	{
		global $contenu;
		if ($inTable == 1)
		{
			$contenu ='<tr>
			<td>'.$caption.' :</td>
			<td><input name="'.$name.'" type="text" size="'.$size.'" value="'.($DestroyRecovery == true ? null : recuperer($name)).'">&nbsp;'.$integrated.'</td>
			</tr>';
		} else {
			$contenu = $caption.' : <input name="'.$name.'" type="text" size="'.$size.'" value="'.($DestroyRecovery == true ? null : recuperer($name)).'">&nbsp;'.$integrated.'';
		}
		return $contenu;
	}
	
	
	function InputTextDimensions ($caption, $name, $typetaille)
	{
		global $contenu;
		$contenu = '<tr>
		<td>'.$caption.' : </td>
		<td><input name="largeur_'.$typetaille.'_'.$name.'" value="'.recuperer('largeur_'.$typetaille.'_'.$name).'" type="text" size="5">
		x
		<input name="hauteur_'.$typetaille.'_'.$name.'" value="'.recuperer('hauteur_'.$typetaille.'_'.$name).'" type="text" size="5"> 
		px </td>
		</tr>';
		return $contenu;
	}
	
	# exemple : InputText ('Description', 'bidule_name', '50', '4', 1)
	function TextArea ($caption, $name, $cols, $rows, $inTable)
	{
		global $contenu;
		if ($inTable == 1)
		{
			$contenu ='<tr>
			<td>'.$caption.' : </td>
			<td><textarea name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'">'.recuperer($name).'</textarea></td>
			</tr>';
		} else {
			$contenu =  $caption.' : <textarea name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'">'.recuperer($name).'</textarea>';
		}
		return $contenu;
	}
	
			
	// FORMULAIRES
	function OpenFormPost ($formName, $onglet, $fieldsetLegend)
	{
		global $contenu, $index;
		$contenu = '<form name="'.$formName.'" method="post" action="index.php?admin&op='.$formName.'"><fieldset><legend>'.$fieldsetLegend.'</legend><table width="100%" id="tableau" border="0" cellspacing="2" cellpadding="0">';
		return $contenu;
	}
	
	function CloseFormPost ()
	{
		global $contenu;
		$contenu = '</table></fieldset>
		<br>
		<fieldset><legend>Actions</legend>
		<div align="center">
		<input type="submit" name="Submit" value="Envoyer">
		<input type="reset" name="Submit" value="R&eacute;initialiser">
		
		</div></fieldset></form>';
		return $contenu;
	}
	
}



?>