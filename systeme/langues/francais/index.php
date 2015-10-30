<?php
/************************************************************************
IwaPHP CMS - Syst�me de gestion de contenu 
*************************************************************************
	
	Last update :  00:19 11/08/2007 - Version du fichier : 1b2
 
	Copyright : (c) 2007 IwaPHP by Damien Galicher
	
	Contact : tokushiro@gmail.com
	
	Site Web : http://iwaphp.free.fr/
	
	Released by tokushiro
		
************************************************************************/

// ---  Portail  --- //
// Footer
define ("PHPVER", null);
define ("INTRO_FOOTER", "Propuls� par") ;
define ("VERSION_FOOTER", "Version") ;
define ("INTRO_LICENSE", "logiciel libre sous licence") ;
define ("YES", "Oui");
define ("NO", "Non");
define ("GEN", "Page g�n�r�e en");
define ("GS", "secondes");
define ("GR", "requ�tes");
define ("BETA", "<i>Non disp. dans cette version</i>");
define ("BETAPP", "<i>Pas au point dans cette version</i>");
define ("PASINFO", "<i>Aucune information</i>");
define ("UC", "D�sol� mais ce site est actuellement en maintenance et non disponible pour le moment.");
define ("FALSEUC", "D�sactiver le mode maintenance");

// Messages pr�d�finis
define ("TITREMSGMODIFOK", "Informations");
define ("MODIFICATIONS_PRISE_EN_COMPTE", "Modifications prises en compte.");
define ("RETOUR_PAGE_PRECEDENTE", "Retourner � la page pr�c�dente");
define ("RETOUR_PAGE_ADMIN", "Retourner � la page administration");

//inf
define ("INFCONNEXION", "Cliquez ici pour vous connecter");
define ("INFINSCRIPTION", "Cliquez ici pour vous inscrire");
define ("INFAVA", "Cliquez pour changer votre avatar.");
define ("INF_AJOUT_AVA", "Vous n'avez aucun avatar. Cliquez pour ajouter un avatar.");
define ("INF_GOEM", "Aller � l'espace membre");
//menu bar
define ("HOME","Accueil");
define ("FORUM","Forum");
// Erreurs
define ("BANNI", "Erreur de session : vous �tes banni de ce site !");
define ("PAGE_DIE", "Impossible d'ouvrir cette page.<br>Soit vous n'�tes pas connect� au site, soit vous n'�tes pas autoris� � voir cette page...");
define ("ERROR_SESSION", "Vous devez �tes connect� au site pour acc�dez � cette partie !");
define ("ERROR_SECONDCOMPTE", "Vous avez d�ja un compte enregistr� sur ce site !<br>Si vous souhaitez enregistrer un nouveau compte veuillez d'abord <a href=".$index->rootfile."?opt=compte&action=deconnexion>vous d�connectez du site</a>.");
define ("ERROR_FORM", "Tous les champs ne sont pas remplis !");
define ("LOW", "Vous n'avez pas les permissions n�cessaires");
// evenements
define ("MODIF_PRIS_EN_COMPTE", "Les modifications ont bien �t� prises en compte !");
define ("RETOUR", "Confirmez");
define ("WAIT", "Veuillez patientez...");
// ---  Modules --- //
// Edito
define ("TITLE_EDITO", "Edito");
// News
define ("TITLE_NEWS", "Voici les derni�res news");
define ("AJOUTERPAR_NEWS", "Ajout� par");
define ("LE_NEWS", "le");
define ("EMPTY_NEWS", "Aucune news pour le moment...");
// Admin News
define ("CMNEWS", "Cr&eacute;er/Modifier une News");
define ("ADCMNEWS", "Administration des news - Cr&eacute;er/Modifier une news");
define ("TITRENEWS", "Titre");
define ("NEWSCTT", "Contenu");
define ("SUPPRIMER_NEWS", "Supprimer");
define ("MODIF_NEWS", "Modifier");
define ("DATE_NEWS", "Date");
// Admin Grades
define ("ADGRADES", "Administration des grades - Liste des grades");
define ("ADGRADESCMMM", "Administration des grades - Cr&eacute;er/Modifier un grade");
define ("ADGRADESCM", "Cr&eacute;er/Modifier un Grade");
define ("MPDCG", "Modifications des permissions de ce grade");
define ("WARNINGGRADESPRINCIPALGENERAL", "Attention ceci est le grade principal de votre site, vous pouvez modifier son titre mais nous vous conseillons pas de changer ses caract�ristiques ou de le supprimer !");
define ("WARNINGGRADESPRINCIPAL", "Attention ceci est le grade principal de votre site,<br> nous vous conseillons pas de changer ses caract�ristiques !");
define ("MODIFDPERMISSIONSDECGRADS", "Modifications des permissions de ce grade");
define ("MODADMING", "Module � administrer");
define ("STATSDEFAULTG", "Statut actuel (oui/non)");
define ("CHOOSESTATSG", "Choisir un statut");
define ("OPGENG", "Options g&eacute;n&eacute;rales du site");
define ("NEWSG", "News");
define ("MENUSG", "Menus");
define ("GRADESG", "Grades");
define ("UTILSG", "Utilisateurs");
define ("GUESTBOOKG", "Livre d'or");
define ("PAGEG", "Pages");
define ("UPDATEG", "Mises � jour");
define ("OPTIG", "Performances et optimisations");
define ("BANG", "Gestion du bannissement");
define ("MLSETG", "Mettre le site en travaux");
define ("GGMG", "Gestion du gestionnaire de modules");
define ("GGMGDEF", "Modules additionnels");
// Admin options
define ("OP_CHANGER_EMAIL", "Autoriser l'utilisateur � changer son adresse e-mail");
define ("OP_CHANGER_PSEUDO", "Autoriser l'utilisateur � changer de pseudo");
define ("ADMIN_OPTIONS", "Administration des options");
define ("PARAM_GEN", "Param&egrave;tres g&eacute;n&eacute;ral du site");
define ("CONFIG_GEN", "Configuration g�n�rale");
define ("C_SITENAME", "Nom de votre site");
define ("C_URLSITE", "Adresse internet de votre site <br>(exemple : http://www.monsite.com/)");
define ("C_URLSCRIPT", "Adresse internet du script <br>(exemple : http://www.monsite.com/iwaphp/)");
define ("C_URLLOGO", "Adresse internet du logo de votre site");
define ("C_MODDEM", "Module par d�fault sur la page d'accueil");
define ("C_MODDEF", "Module actuel");
define ("C_SKINDEF", "Th�me par d�fault");
define ("C_SKINACTUEL", "Th�me actuel");
define ("MENTIONSLEGAL", "Mentions l�gale");
define ("PROPRIO", "Propri�taire du site");
define ("EMAIL_PROPRIO", "Adresse e-mail du propri�taire du site");
define ("YOUR_COPYRIGHTS", "Vos copyrights");
define ("METAS", "Metas-tags");
define ("DESSITE", "Courte description de votre site");
define ("KEYWORDSSITE", "Mots cl�s de votre site");
define ("C_LANG", "Langue du portail");
define ("C_LANGACT", "Langue actuelle");
define ("C_GRADECURRENT", "Grade par d�faut lors de l'inscription");
define ("C_GRADECURRENTACT", "Grade actuel");
define ("C_TAPENAMEFILELANGUAGE", "Tapez le nom du fichier");
define ("C_TAPENAMEFILETHEME", "Tapez le nom du dossier");
define ("C_REGLES", "R�gles du site");
//Admin menus
define ("MENUGAUCHE", "Menu de gauche");
define ("MENUDROITE", "Menu de droite");
define ("CREERMODIFIERMENU", "Cr�er/modifier un menu");
define ("HELPCREATEMENUS", "Vous pouvez ajouter du texte ou du code HTML dans le contenu de votre menu<br><b>Cr�er un lien :</b> &lt;a href=&quot;url_de_la_page&quot;&gt;nom_de_votre_lien&lt;/a&gt;<br><strong>Faire un saut de ligne :</strong> &lt;br&gt;");
define ("MENUFIXE", "Menu Fixe");
define ("POS", "Position");
define ("EMPLACEMENT", "Emplacement");
define ("NOMMOD", "Nom du module");
// Toolbar
define ("APPLIQUER", "Appliquer");
define ("CANCEL", "Retour");
define ("HELP", "Aide");
define ("ADD", "Ajouter");
// ---  Espace membre  --- //
define ("ESPACE_MEMBRE", "Espace Membre");
define ("VOUSETESICI", "Vous &ecirc;tes ici");
define ("MES_OPTIONS", "Mes Options");
define ("MON_COMPTE", "Mon Compte");
define ("MA_MESSAGERIE", "Ma Messagerie");
define ("ADMIN", "Administration");
define ("NAV", "Navigation");
define ("RETOUR_INDEX", "Retour &agrave; l'accueil");
define ("RETOUR_EM", "Retour &agrave; l'espace membre");
define ("RETOUR_ADMIN", "Retour &agrave; l'administration");
define ("RETOUR_LIST_NEWS", "Retour � la liste des news");
define ("RETOUR_LIST_GRADES", "Retour � la liste des grades");
define ("RETOUR_LIST_MENUS", "Retour � la liste des menus");
define ("RETOUR_MONCOMPTE", "Retour &agrave; mon compte");
define ("RETOUR_MESOPTIONS", "Retour &agrave; mes options");
define ("RETOUR_LISTUTILS", "Retour � la liste des utilisateurs");
define ("ACTIVEOK", "Votre compte � bien �t� activ�.");
define ("ACTIVEERROR", "Un probl�me est survenu, il est possible que vous n'�tes pas inscrit ou que l'adresse est fausse ou que vous �tes d�j� valid� !.");
define ("INFO_ID", "Veuillez entrez ici votre identifiant pour pouvoir acc�dez � votre espace membre");
define ("INFO_PASS", "Veuillez entrez ici votre mot de passe personnel pour pouvoir acc�dez � votre espace membre");
define ("INFO_CCOMPTE", "Si vous ne possedez par encore de compte sur ce site cliquez ici pour en cr�er un gratuitement");
define ("INFO_PASSPERDU", "Cette option vous permet de r�cuperer votre mot de passe en cas de perte");

// Session statut et espace membre avec admin
define ("VA", "Vous avez");
define ("NEWMSG", "nouveau(x) message(s)");
define ("BIENVENUE_INVITE", "Bienvenue invit�");
define ("BIENVENUE", "Bienvenue");
define ("CONNEXION", "Connexion");
define ("INSCRIPTION", "Inscription");
define ("LOGIN_IN", "Connect� en tant que");
define ("DECONNEXION", "D�connexion");
define ("SEDECONNECTER", "Se&nbsp;d&eacute;connecter");
define ("MES_CONTROLES", "Espace membre");
define ("MESSAGERIE", "Messagerie");
define ("DEFINE_PROFIL", "Permet de g&eacute;rez votre profil (changer vos informations de votre compte d'utilisateur...). ");
define ("CHANGE_PROFIL", "Changer mon profil");
define ("DEFINE_OPTION", "Permet de modifier vos pr&eacute;f&eacute;rences (option de navigation, apparence du site...).");
define ("CHANGE_AVATAR", "Changer d'avatar");
define ("CHANGE_SIGN", "Changer de signature");
define ("PENSE_BETE_GERER", "G�rer mon pense-b�te");
define ("CHANGE_EMAIL", "Changer mon adresse e-mail");
define ("CHANGE_PASS", "Changer mon mot de passe");
define ("CHANGE_PSEUDO_DMD", "Demander un changement de pseudo");
define ("CHANGE_DESIGN", "Changer le th�me du site");
define ("CHANGE_DESIGNDEF", "Change l'apparence graphique du site");
define ("CHG_OP_NAV", "Changer mes options de navigation");
define ("FORMT_D_H", "Changer le format des dates et heures");
define ("SIGN_OUT_NEWSL", "Se d�sinscrire de la newsletter");
define ("DEFINE_MESSAGERIE", "Permet de g&eacute;rez vos messages sur ce site. ");
define ("CONSULT_MP", "Consulter mes messages priv�es");
define ("CONSULT_MP_S", "Consulter mes messages priv�es supprim�s");
define ("CONSULT_MP_CE", "Consulter mes messages priv�es en cours d'envoi");
define ("CONSULT_MP_E", "Consulter mes messages priv�es envoy�s");
define ("CONSULT_FRIENDS", "Consulter ma liste d'amis");
define ("DEFINE_ADMIN", "G�rer et modifier votre portail par le biais de l'administration.");
define ("ADMIN_OP", "Param�tres g�n�ral du site");
define ("ADMIN_NEWS", "Administration des news");
define ("ADMIN_MENUS", "Apparence");
define ("ADMIN_GRADES", "Gestion des rangs");
define ("ADMIN_USERS", "Administration des utilisateurs");
define ("ADMIN_UPDATE", "V�rifier les mises � jour de IwaPHP");
define ("ADMIN_PAGE", "Administration des pages");
define ("ADMIN_LIVREDOR", "Administration du livre d'or");
// Connexion 2 
define ("INCORRECT", "Votre Identifiant ou votre Mot de passe est incorrect");
define ("PASACTIF", "Votre compte n'est pas encore activ�");
define ("ALLOK", "Connexion r�ussite. Cr�ation de la session...");
// Connexion form
define ("WARNING", "Attention !");
define ("MESSAGE_CEM", "Vous devez avoir d&eacute;j&agrave; enregistr&eacute; un compte avant de pouvoir vous connecter.<br> Si vous n'avez pas de compte, vous pouvez vous inscrire d&egrave;s maintenant en cliquant <a href=".$index->targetfile."=espace_membre&action=inscription>ici</a>.");
define ("MESSAGE_CEMMINI", "Si vous n'avez pas de compte, vous pouvez vous inscrire d&egrave;s maintenant en cliquant <a href=".$index->targetfile."=espace_membre&action=inscription>ici</a>.");
define ("TITRE_CEM", "Connexion &agrave; l'espace membre");
define ("SAISIEPSEUDO_CEM", "Merci de saisir votre identifiant");
define ("SAISIEPASS_CEM", "Merci de saisir votre mot de passe");
define ("SUBMIT_CONNECT", "Connectez-moi");
define ("ONCLICK_SUBMIT_CONNECT", "Patientez...");
define ("TITRE_OPTIONS_CEM", "Options de connexion"); 
define ("ID_P_CEM", "Identifiant perdu ?");
define ("NO_LOGIN", "Pas encore membre ?");
define ("R_PSEUDOPASS", "Retenir mon identifiant et mon mot de passe");
define ("R_PSEUDO", "Retenir seulement mon identifiant");
define ("R_WRONG", "Ne pas retenir mon identifiant et mon mot de passe");
//mini connexion
define ("NUT", "Identifiant");
define ("MDP", "Mot de passe");
define ("MINIINS", "Inscription");
define ("ONLINE", "En ligne");
define ("VISITOR", "Visiteurs");
define ("MEMBERS", "Membres");
define ("MEMBERSONLINE", "Membres en ligne");
define ("ANONYMOUS", "Anonyme");
define ("STATS", "Statistiques");
// Deconnexion
define ("MSG_LOGOUT", "D�connexion r�ussite. Suppression de la session...");
// Inscription
define ("ATTENTION", "Attention !");
define ("ATT_EMAIL", "Vous devez nous fournir une adresse e-mail correcte, pour recevoir le e-mail d'activation de votre compte sur ce site.<br>(*) Champs obligatoire.");
define ("RMQ", "Remarque");
define ("LOIS", "En vertu de l'article 27 de la loi n&deg; 78-17 du 6-01-1978, vous avez droit d'acc&egrave;s et de rectification aux donn&eacute;es personnelles vous concernant.");
define ("FORM_SIGNUP", "Formulaire d'inscription");
define ("ENTER_NU", "Entrer votre identifiant souhait�");
define ("ENTER_MDP", "Saisissez un mot de passe");
define ("WEAK", "Faible");
define ("MEDIUM", "Moyen");
define ("STRONG", "Fort");
define ("CONFIRM_PASS", "Confirmez le mot de passe");
define ("TAPE_EMAILL", "Saisissez votre adresse e-mail");
define ("FACULTATIFS_INFOSS", "Informations facultatives");
define ("TAPENAME", "Saisissez votre Nom");
define ("TAPESURNAME", "Saisissez votre Prenom");
define ("TAPEURLWEBSITE", "Saisissez l'adresse de votre Site Web");
define ("TAPEINTER", "Saisissez le nom de votre Pays");
define ("TAPEBORN", "Saisissez votre Date de Naissance (jj/mm/aa)");
define ("REGLESLIRE", "Termes et r�gles d'utilisation");
define ("LUANDACCEPT", "J'ai lu et j'accepte le reglement");
define ("SOUMETTRE_SIGNUP", "Soumettre l'inscription");
define ("RESETFORM", "R&eacute;initialiser");
define ("RMQ_REGLES", "<b>/!\ Voici les r�gles qui sont impos� sur ce site /!\</b>");
define ("NOTE_REGLES", "<b>Note</b> : en validant ce formulaire d'inscription vous acceptez les r�gles qui sont impos� sur ce site.");
// inscription 2
define ("BONJOUR", "Bonjour");
define ("BIENVENUE_SUR", "et bienvenue sur");
define ("MESSAGE1", "Vous venez de vous inscrire et nous sommes heureux<br>de pouvoir vous compter aujourd'hui parmi nos membres.<br>");
define ("MESSAGE1_1", "Voici un rappel de vos identifiants, notez les pr�cieusement : <br>");
define ("MESSAGE1_2", "Votre Identifiant :");
define ("MESSAGE1_3", "Votre Mot de passe:");
define ("MESSAGE1_4", "Votre Mail:");
define ("MESSAGE1_5", "Si vous souhaitez changer vos informations, rendez-vous dans votre compte pour les mettre � jour.<br>");
define ("MESSAGE1_6", "Votre Cl� d\'activation:<br>");
define ("MESSAGE1_7", "A tr�s bient�t sur le site!");
define ("MESSAGE1_8", "L'�quipe de ");
define ("EXISTPSEUDO", "L'identifiant ou l'email est d�j� utilis�, merci d'en choisir un(e) autre. <a href=javascript:history.back(1)>Retour au formulaire</a>");
define ("MANQUECHAMPS", "Un ou plusieurs champs ne sont pas remplis, <a href=javascript:history.back(1)>Retour au formulaire</a>");
define ("PASSNOIDENTIQUE", "Les mots de passe ne sont pas identiques, <a href=javascript:history.back(1)>Retour au formulaire</a>");
define ("CONTRAGULATIONS", "F�licitations, vous �tes maintenant inscrit sur ");
define ("RECEVIEWEMAIL", ". <br>Vous allez recevoir un e-mail pour activer votre compte. <br><a href=index.php>Retour � l'Accueil</a>");
define ("BIENVENUE_SURR", "Bienvenue sur");
define ("VOTREADRESSEEMAIL", "Votre adresse e-mail");
define ("NESTPASCORRECTE", "n'est pas correcte. <a href=javascript:history.back(1)>Retour au formulaire</a>");
//changer profil
define ("MODIF_PROFIL_PERSO", "Modification de votre profil personnel");
define ("MODIF_PROFIL", "Changer mon profil");
define ("MODIF_INFO_DE_PROFIL", "Modification de vos informations de profil");
define ("ENTER_NEW_PASS_IFOK", "Entrez un nouveau mot de passe si vous le souhaitez.");
define ("ICQ", "Num�ro ICQ");
define ("AIM", "Adresse AIM");
define ("MSNM", "MSN Messenger");
define ("YM", "Yahoo Messenger");
//changer avatar
define ("CHANGE_AVA", "Changer mon avatar");
define ("MODIF_AVA", "Modification de votre avatar");
define ("VOTRE_AVA_ACTUEL", "Votre avatar actuel");
define ("MODIFIER_AVA", "Modifier votre avatar");
define ("PHRASE_INFO_AVA", "Tapez l'adresse cible de l'avatar, exemple (http://monsite.com/monavatar.jpg)<br> Format support� <b>PNG</b>, <b>JPEG</b> et <b>GIF</b>");
define ("UP_ERROR_TYPE", "Vous devez uploader un fichier de type png, gif, jpg ou jpeg...");
define ("UP_ERROR_POIDS", "Le fichier est trop gros...");
define ("UPLOAD_OK", "Upload effectu� avec succ�s !");
define ("UPLOAD_ERROR", "Echec de l'upload !");
//changer la signature
define ("EMPTY_SIGN", "<i>Aucune signature</i>");
define ("MODIF_VSIGN", "Modification de votre signature");
define ("VSIGN_DEFAULT", "Votre signature actuelle");
define ("CHANG_SIGNATURE", "Changer ma signature");
define ("MODIF_SIGNATURE", "Modifier votre signature");
define ("AVA_EXT", "Avatar ext�rieur au site");
define ("AVA_UP", "Uploader un avatar � partir de votre ordinateur");
define ("AVA_UP_SUBMIT", "Envoyer le fichier");
// --- stats --- //
// mini stats
define ("VISITEURS", "Visiteurs");
define ("S_TEXTE_AVANT", "Il y a actuellement");
define ("S_TEXTE_APRES", "visiteur(s) connect�(s)");


// Messagerie Priv�e
define ("INBOX", "Bo�te de r�ception");
define ("LU", "Lu");
define ("NONLU", "Non lu"); 
define ("SUJET", "Sujet");
define ("AUTEUR", "Auteur");
define ("DATE", "Date");
define ("RET_INBOX" , "Retour � la messagerie interne");
define ("MSGINT", "Messagerie interne");
define ("MSGBDR", INBOX);
define ("MSGENV", "Boite d'envoi");
define ("MSGSUP", "Messages supprim�s");
define ("NEWW", "Nouveau");
define ("READMSG", "Lecture du message");
define ("NAMEEXPMSG", "Pseudo de l'expediteur");
define ("REPONDRE", "R�pondre");
define ("MSG", "Message");
define ("MSG_MARQUER_LU", "Message marqu� lu redirection en cours");
define ("MSG_DEPLACER_DANS_CORBEILLE", "Message d�plac� dans la corbeille redirection en cours");
define ("REP_SEND", "R�ponse envoy�e");
define ("DESTINATAIRE", "Destinataire");
define ("REP_MSG", "R�ponse au message");
define ("A_ECRIT", "a ecrit");
define ("ENVOYER", "Envoyer");
define ("PSEUDO_EXP", "Pseudo de l'expediteur");
define ("MSGTOTALSUPP", "Message totalement supprim�, cette action est irr�versible Redirection dans 5 secondes");
define ("ACTION_IRREMEDIABLE", "Attention cette action est irrem�diable");
define ("REDIGER_NEW_MSG", "R�diger un nouveau message");




//renvoi infos par mail
define ("RIPM_ERROR_MAIL", "Vous n'avez pas saisi d'e-mail.");
define ("RIPM_ERROR_NOTEXIST_MAIL", "Cette adresse e-mail n'existe pas.");
define ("RIPM_TXTI", "Comme vous l'avez demand�");
define ("RIPM_TXTII", "voici un rappel de vos identifiants, notez les pr�cieusement");
define ("RIPM_TXTIII", "Rappel de vos identifiants.");
define ("RIPM_TXTIV", "Votre adresse a bien �t� reconnue.<br>Votre Pseudo et votre Code vous ont �t� envoy�s par e-mail.<br>Vous devriez les recevoir dans votre bo�te aux lettres dans quelques instants.");
//memberlist
define ("TITREMEMBERLIST", "Liste des membres");
define ("ML_PSEUDO", "Pseudo ou Identifiant");
define ("ML_RANG", "Rang ou groupe");
define ("ML_COUNTRY", "Localisation");
define ("ML_WEBSITE", "Son site");
define ("ML_EMAIL", "E-mail");
define ("ML_MP", "Lui envoyer un message priv&eacute;");
define ("ML_NOMCOMPLET", "Nom complet");
define ("ML_BORN", "Date de naissance");
define ("ML_SIGN", "Signature");
define ("ML_ERASE", "Effacer ce membre");
define ("ML_MODIF", "Modifier ce membre");
//livre d'or
define ("LIVREDOR", "Livre d'or");
define ("MESSAGE", "Contenu de votre message");
define ("LD_SUBMIT", "Envoyer mon message");
define ("LD_AWRIT", "a �crit");
define ("PAGE", "Page");
//Admin utilisateur
define ("ADMIN_UTILS", "Administration des utilisateurs");
define ("ML_BANNIR", "Bannir ce membre");
define ("ML_DEBANNIR", "Ne plus bannir ce membre");
define ("ML_DEAVERTO", "Ne plus avertir ce membre");
define ("ML_AVERTO", "Avertir ce membre");
define ("ML_ACTIVE", "Activer ce membre");
define ("ML_AUTORZ", "Autorisations");
define ("AU_EFFMCONFIRM", "Etes vous sur de vouloir effacer ce membre");
define ("OPEFFEC", "Op�ration effectu�");
define ("AVERTO", "<span style='color:#FF6600; '><b>ATTENTION ! : Un administrateur vient de vous placer dans les utilisateurs dit dangeureux ! surement du � un non respect de votre part du r�glement du site.<br>Remarque : Ceci est un avertissement avant le banissement !</b></span>");
//
define ("GMODULES", "G&eacute;rer des modules");
define ("PCONFIG", "Pannel de configuration");
define ("OPTI", "Optimisation");
define ("BAN", "Gestion du banissement");
define ("PUT_UNDER_CONSTRUCTION", "Mettre le site en travaux");
define ("PUC_DEFINE", "Vous avez la possibilit&eacute; de mettre le site en travaux ce qui  bloquera le site aux visiteurs.");

define ("PCDEF", "Modifier les param&egrave;tres g&eacute;n&eacute;raux du portail.");
define ("GMODDEF", "Vous permet de g&eacute;rer des modules additionnels si vous en avez les permissions n�cessaires. ");
define ("UPDATE", "V�rifier les mises � jour");
define ("DEFUP", "V&eacute;rifier si de nouvelles mises &agrave; jour sont disponible pour le portail.");
define ("APROPO", "A propos de IwaPHP");
define ("DEFAPROPO", "Plus d'informations sur cette version de IwaPHP.");

define ("EDITION", "Edition");
define ("VERSIONFULL", "Version compl&egrave;te et stable");
define ("CORRECTIF", "Num&eacute;ro du correctif"); 
define ("LANGGDDE", "Langage par d&eacute;faut");
define ("LICENCE", "Propri�taire du site");
define ("PATCHON", "Patch install&eacute;");
define ("WEBSITEMAJ", "Site web des mises &agrave; jour");
define ("CDMAJDIP", "Centre de mises &agrave; jour de IwaPHP");

define ("UP_UP", "Mettre &agrave; jour");
define ("UP_SIG", "Signaler un dysfonctionnement");
define ("UP_DMOD", "T&eacute;l&eacute;charger de nouveaux modules");
define ("UP_DSKI", "T&eacute;l&eacute;charger de nouveaux th&egrave;mes graphiques");
define ("CLIK", "Cliquez-ici");
define ("IFNOT", "si rien ne se passe");


//define ("", "");

?>