<?php  

include '../FormValidation.php';

$text = "
hej det harar en kommentar
<p>Utterliagre text i en kommentar</p>
<code>
function some(){
	echo 'something';
}</code>
<div>This is harmful code and i dont like it:)</div>
";

$val = new FormValidation();
echo $val->strip_html_tags($text);
echo "</br>";
var_dump($val->valEmail("bomail@sdsddsaassasamail.fx"));
echo "</br>";
var_dump($val->valUrl("www.pontuskarlsson.se"));
echo "</br>";
$censored = array("fet", "ful");
$str = "Du ar fet och ful!";
var_dump($val->word_censor($str, $censored));
echo "</br>";
$html = "<p>String with text without ending<p>string>p><p>another<p>";
var_dump($val->fixHtml($html));
?>