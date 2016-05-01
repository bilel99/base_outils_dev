<?php

// Genere un password aleatoire
function generatePassword($nb)
{
    $liste_chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $maxi = strlen($liste_chars)-1;

    $new_password = '';

    for($i=1; $i<=$nb; $i++)
    {
        $new_password .= substr($liste_chars,rand(0,$maxi),1);
    }

    return $new_password;
}

// Verifie que la chaine passee en parametre est au format email
function isEmail($value)
{
    if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#',$value))
    {
        return true;
    }
    else
    {
        return false;
    }
}

// Encode les caracteres speciaux
function speChar2HtmlEntities($string)
{
    $str_trans = array('Ŕ'=>'&Agrave;', 'ŕ'=>'&agrave;', 'Á'=>'&Aacute;', 'á'=>'&aacute;', 'Â'=>'&Acirc;', 'â'=>'&acirc;', 'Ă'=>'&Atilde;', 'ă'=>'&atilde;', 'Ä'=>'&Auml;', 'ä'=>'&auml;', 'Ĺ'=>'&Aring;', 'ĺ'=>'&aring;', 'Ć'=>'&AElig;', 'ć'=>'&aelig;', 'Ç'=>'&Ccedil;', 'ç'=>'&ccedil;', 'Đ'=>'&ETH;', 'đ'=>'&eth;', 'Č'=>'&Egrave;', 'č'=>'&egrave;', 'É'=>'&Eacute;', 'é'=>'&eacute;', 'Ę'=>'&Ecirc;', 'ę'=>'&ecirc;', 'Ë'=>'&Euml;', 'ë'=>'&euml;', 'Ě'=>'&Igrave;', 'ě'=>'&igrave;', 'Í'=>'&Iacute;', 'í'=>'&iacute;', 'Î'=>'&Icirc;', 'î'=>'&icirc;', 'Ď'=>'&Iuml;', 'ď'=>'&iuml;', 'Ń'=>'&Ntilde;', 'ń'=>'&ntilde;', 'Ň'=>'&Ograve;', 'ň'=>'&ograve;', 'Ó'=>'&Oacute;', 'ó'=>'&oacute;', 'Ô'=>'&Ocirc;', 'ô'=>'&ocirc;', 'Ő'=>'&Otilde;', 'ő'=>'&otilde;', 'Ö'=>'&Ouml;', 'ö'=>'&ouml;', 'Ř'=>'&Oslash;', 'ř'=>'&oslash;', ''=>'&OElig;', ''=>'&oelig;', 'ß'=>'&szlig;', 'Ţ'=>'&THORN;', 'ţ'=>'&thorn;', 'Ů'=>'&Ugrave;', 'ů'=>'&ugrave;', 'Ú'=>'&Uacute;', 'ú'=>'&uacute;', 'Ű'=>'&Ucirc;', 'ű'=>'&ucirc;', 'Ü'=>'&Uuml;', 'ü'=>'&uuml;', 'Ý'=>'&Yacute;', 'ý'=>'&yacute;', ''=>'&Yuml;', '˙'=>'&yuml;');

    return strtr($string,$str_trans);
}

// Enleve les accents
function speCharNoAccent($string)
{
    $str_trans = array('Ŕ'=>'A', 'ŕ'=>'a', 'Á'=>'A', 'á'=>'a', 'Â'=>'A', 'â'=>'a', 'Ă'=>'A', 'ă'=>'a', 'Ä'=>'A', 'ä'=>'a', 'Ĺ'=>'A', 'ĺ'=>'a', 'Ç'=>'C', 'ç'=>'c', 'Č'=>'E', 'č'=>'e', 'É'=>'E', 'é'=>'e', 'Ę'=>'E', 'ę'=>'e', 'Ë'=>'E', 'ë'=>'e', 'Ě'=>'I', 'ě'=>'i', 'Í'=>'I', 'í'=>'i', 'Î'=>'I', 'î'=>'i', 'Ď'=>'I', 'ď'=>'i', 'Ń'=>'N', 'ń'=>'n', 'Ň'=>'O', 'ň'=>'o', 'Ó'=>'O', 'ó'=>'o', 'Ô'=>'O', 'ô'=>'o', 'Ő'=>'O', 'ő'=>'o', 'Ö'=>'O', 'ö'=>'o', ''=>'OE', ''=>'oe', 'Ů'=>'U', 'ů'=>'u', 'Ú'=>'U', 'ú'=>'u', 'Ű'=>'U', 'ű'=>'u', 'Ü'=>'U', 'ü'=>'u', 'Ý'=>'Y', 'ý'=>'y', ''=>'Y', '˙'=>'y');

    return strtr($string,$str_trans);
}
// Nettoie une chaine pour l'inserer dans un csv
function nettoyageCsv($string)
{
    $new_string = str_replace(";","-",$string);
    $new_string = str_replace("\n\r"," ",$new_string);
    $new_string = str_replace("\r\n"," ",$new_string);
    $new_string = str_replace("\r"," ",$new_string);
    $new_string = str_replace("\n"," ",$new_string);

    return $new_string;
}

// Coupe la chaine $str avec une limite max de $limite, mais sans couper au milieu d'un mot ou d'une entite HTML
function subword($str, $limite)
{
    $str = trim(strip_tags($str));
    $tableWord = str_word_count($str, 1,'0123456789&;');

    $nbrlettre = 0;
    foreach($tableWord as $word)
    {
        $nbrlettre += strlen($word);
        if($nbrlettre >= $limite)
        {
            break;
        }
        else
        {
            $nbrlettre++;
        }
    }
    if(strlen($str)>$nbrlettre)
    {
        return $phrase = substr($str,0,$nbrlettre).'...';
    }
    else
    {
        return $str;
    }
}




// Une fonction qui determine l'extention de n'importe-quel fichier / url...
function extention($ext)
{
    // fonctionnement : echo extention("uploads/fichiers/fichier.arnaud.gz"); return gz
    $ext = substr($ext,strrpos($ext,".")+1);
    return $ext;
}



// Convertit la chaine sans accent
function strToNoAccent($var) {
    // Utilisation de la fonction
    // $ceciestlenom = strToNoAccent($chaine);
    $modif = str_replace(
        array(
            utf8_decode('à'), utf8_decode('â'), utf8_decode('ä'), utf8_decode('á'), utf8_decode('ã'), utf8_decode('å'),
            utf8_decode('î'), utf8_decode('ï'), utf8_decode('ì'), utf8_decode('í'),
            utf8_decode('ô'), utf8_decode('ö'), utf8_decode('ò'), utf8_decode('ó'), utf8_decode('õ'), utf8_decode('ø'),
            utf8_decode('ù'), utf8_decode('û'), utf8_decode('ü'), utf8_decode('ú'),
            utf8_decode('é'), utf8_decode('è'), utf8_decode('ê'), utf8_decode('ë'),
            utf8_decode('ç'), utf8_decode('ÿ'), utf8_decode('ñ'),
            utf8_decode('À'), utf8_decode('Â'), utf8_decode('Ä'), utf8_decode('Á'), utf8_decode('Ã'), utf8_decode('Å'),
            utf8_decode('Î'), utf8_decode('Ï'), utf8_decode('Ì'), utf8_decode('Í'),
            utf8_decode('Ô'), utf8_decode('Ö'), utf8_decode('Ò'), utf8_decode('Ó'), utf8_decode('Õ'), utf8_decode('Ø'),
            utf8_decode('Ù'), utf8_decode('Û'), utf8_decode('Ü'), utf8_decode('Ú'),
            utf8_decode('É'), utf8_decode('È'), utf8_decode('Ê'), utf8_decode('Ë'),
            utf8_decode('Ç'), utf8_decode(''), utf8_decode('Ñ'),
        ),
        array(
            'a', 'a', 'a', 'a', 'a', 'a',
            'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u',
            'e', 'e', 'e', 'e',
            'c', 'y', 'n',
            'A', 'A', 'A', 'A', 'A', 'A',
            'I', 'I', 'I', 'I',
            'O', 'O', 'O', 'O', 'O', 'O',
            'U', 'U', 'U', 'U',
            'E', 'E', 'E', 'E',
            'C', 'Y', 'N',
        ),$var);
    $var=utf8_encode($modif);
    return $var;
}

