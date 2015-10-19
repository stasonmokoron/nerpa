<?php 						
	$pageObj_arr = Tpage::getByTitle($page_title);

		if (is_array($pageObj_arr)) foreach ($pageObj_arr as $pageObj) {		
									
			$lang_pos_arr = $pageObj -> getLangPOS();

			if (is_array($lang_pos_arr)) foreach ($lang_pos_arr as $langPOSObj) {
										
				$meaning_arr = $langPOSObj -> getMeaning();

				//$count_meaning = 1;
				if (is_array($meaning_arr)) foreach ($meaning_arr as $meaningObj) {
					$meaning_id = $meaningObj->getID();

					// MEANING
					print "<p title=\"TPage::TLangPOS::TMeaning::TWikiText->text\">". join(', ',$label_name_arr). " ". $meaningObj->getWikiText()->getText() ."</p>\n";
				}
			}
		}
?>