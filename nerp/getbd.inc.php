<?php 					
	if (isset($page_title)) {
		if($page_title=="") print "<p>Введите слово!</p>";
		else{
				$pageObj_arr = Tpage::getByTitle($page_title);
				if ($pageObj_arr == NULL) {
					print "<p>The word has not founded.</p>\n";
				} else {
					if (sizeof($pageObj_arr) > 1) 
					print "<p>There are founded ". sizeof($pageObj_arr) ." words.</p>\n";

					if (is_array($pageObj_arr)) foreach ($pageObj_arr as $pageObj) {
									
									
						// вывод слова и ссылка на статью в Викисловаре
						print //"<h2 title=\"TPage->page_title\" style=\"color: #006a4e\">".$pageObj->getPageTitle()."</h2>\n".
							"<p>Source page at ".TPage::getURL($pageObj->getPageTitle(), WIKT_LANG.".wiktionary.org")."</p>";
									
									
						$lang_pos_arr = $pageObj -> getLangPOS();

						if (is_array($lang_pos_arr)) foreach ($lang_pos_arr as $langPOSObj) {
										
										
							// вывод языковой принадлежности и части речи
							print "<h3 title=\"TPage::TLangPOS::TLang->name\">".$langPOSObj->getLang()->getName()."</h3>\n".
								"<p title=\"TPage::TLangPOS::TPOS->name\">Part of speach: <b>". $langPOSObj->getPOS()->getName() ."</b></p>\n";
										
											
							$meaning_arr = $langPOSObj -> getMeaning();

							$count_meaning = 1;
							if (is_array($meaning_arr)) foreach ($meaning_arr as $meaningObj) {
								$meaning_id = $meaningObj->getID();

								// LABELS OF MEANING
								$labelMeaning_arr = $meaningObj->getLabelMeaning();
								$label_name_arr = array();
									
								if (is_array($labelMeaning_arr)) foreach ($labelMeaning_arr as $labelMeaningObj) {
									$label_name_arr[] = "<i><span title=\"".$labelMeaningObj->getLabel()->getName()."\">".$labelMeaningObj->getLabel()->getShortName()."</span></i>";
								}

								// MEANING
								print "<p title=\"TPage::TLangPOS::TMeaning::TWikiText->text\">".$count_meaning++.". ". join(', ',$label_name_arr). " ". $meaningObj->getWikiText()->getText() ."</p>\n".
									"<ul>\n";

								// RELATIONS
								$relation_arr = $meaningObj -> getRelation();

								$relation_RelationType_arr = array(); // array of relations groupped by types
								$relation_name_arr = array(); // array of relation names groupped by types

								if (is_array($relation_arr)) foreach ($relation_arr as $relationObj) {
									$relationTypeName = $relationObj->getRelationType()->getName();
									$relation_RelationType_arr[$relationTypeName][] = $relationObj;
									$relation_name_arr[$relationTypeName][] = "<span title=\"TPage::TLangPOS::TMeaning::TRelation::WikiText->text\">".$relationObj->getWikiText()->getText()."</span>";
								}

								foreach ($relation_RelationType_arr as $relationTypeName => $relationObj_arr) {
									print "<p title=\"TPage::TLangPOS::TMeaning::TRelation::TrelationType->name\"><b>". $relationTypeName ."</b>: ". join(', ', $relation_name_arr[$relationTypeName]) ."</p>";
								}
								print "</ul>\n";
							}
						}
		
								/*print "<PRE>";
								print_r($meaningObj);
								print "</PRE>";
								var_dump($pageObj);
								print_r($pageObj);*/
					}
				}
			}	
		}
?>