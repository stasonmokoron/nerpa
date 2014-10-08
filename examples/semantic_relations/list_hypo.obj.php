<?php
$mtime = explode(" ",microtime()); 
$tstart = $mtime[1] + $mtime[0];  // Write start time of execution

include("../../config.php");
include(LIB_DIR."header.php");

$lang_id_ru        = TLang::getIDByLangCode("ru");
$pos_id_noun       = TPOS::getIDByName("noun");
$relation_type_id_hyponyms  = TRelationType::getIDByName("hyponyms");
$relation_type_id_hypernyms = TRelationType::getIDByName("hypernyms");


print "<h3>Generation of list of hyponyms and hypernyms (LIMIT 100)</h3>\n".
      "Database version: ".NAME_DB."<BR>\n".

      "lang_id_ru = $lang_id_ru<BR>\n".
      "ID of part of speech \"noun\" = $pos_id_noun<BR>\n".
      "ID of relation type \"hyponyms\" = $relation_type_id_hyponyms<BR>\n".
      "ID of relation type \"hypernyms\" = $relation_type_id_hypernyms<BR>\n<BR>\n";

$query_lang_pos = "SELECT id FROM lang_pos WHERE lang_id=".(int)$lang_id_ru." and pos_id='$pos_id_noun' LIMIT 100";
$result_lang_pos = $LINK_DB -> query($query_lang_pos,"Query failed in file <b>".__FILE__."</b>, string <b>".__LINE__."</b>");

print "<table border=1>\n";
$counter = 0;
while($row = $result_lang_pos-> fetch_object()){
    $lang_pos = TLangPOS::getByID($row->id);
   
    // 2. get array of meanings
    $meaning_arr = $lang_pos->getMeaning();
    if (is_array($meaning_arr)) foreach ($meaning_arr as $meaning_obj) {
        
        // 3. get array of relations
	$relation_arr = $meaning_obj->getRelation();
	if (is_array($relation_arr)) foreach ($relation_arr as $relation_obj) {
            $relation_type = $relation_obj->getRelationType();
            
            // 4. filter by relation type
            if($relation_type->getID() != $relation_type_id_hyponyms && 
               $relation_type->getID() != $relation_type_id_hypernyms)
                continue;
            
            // 5. get relation word by $wiki_text_id
            $relation_wiki_text = $relation_obj->getWikiText();

            if($relation_wiki_text != NULL){
                print "<tr><td>".(++$counter).".</td><td>".$lang_pos->getPage()->getPageTitle()."</td><td>".$relation_type->getName()."</td><td>".$relation_wiki_text->getText()."</td></tr>\n";
            }
        }// eo relation
    } // eo meaning
}
print "</table><br />\nTotal semantic relations (with these parameters): $counter<BR>";

$mtime = explode(" ",microtime());
$mtime = $mtime[1] + $mtime[0];
printf ("Page generated in %f seconds!", ($mtime - $tstart));
?>