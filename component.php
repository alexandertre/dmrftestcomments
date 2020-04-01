<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("highloadblock"))
{
    $this->AbortResultCache();
    ShowError('IBLOCK_MODULE_NOT_INSTALLED');
    return;
}
			 $ID = $arParams["HLBCODE"];
			  

    $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();
    $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
    $hlDataClass = $hldata["NAME"] . "Table";
	$request = \Bitrix\Main\Context::getCurrent()->getRequest();
		

		
		if (CModule::IncludeModule('highloadblock')) {
	if(($request->isPost('usrname'))&&($request->isPost('commenttext'))){
    $rqstprmtrs = $request->getPostList()->toArray();
    $result = $hlDataClass::add(array(
      'UF_NAME' => $rqstprmtrs['usrname'],
      'UF_FULL_DESCRIPTION' => $rqstprmtrs['commenttext'],
      'UF_FORLINK' => $arParams["ID"],
	  'UF_LINK' => $arParams["ID"]
      ));
	 unset($_POST);
		}
	
	
    $result = $hlDataClass::getList(array(
                "select" => array("ID", "UF_NAME", "UF_XML_ID", "UF_FORLINK", "UF_FULL_DESCRIPTION"), // Поля для выборки
                "order" => array("ID" => "ASC"),
                "filter" => array('UF_FORLINK' => $arParams["ID"]),
    ));
    $commentsarray = array();
    while ($res = $result->fetch()) {
		 $commentsarray[] = array(
	     'commentid' => $res['ID'],
	     'commentname' => $res['UF_NAME'],
	     'commenttext' => $res['UF_FULL_DESCRIPTION'],
	     'commentnews	link' => $res['UF_FORLINK'],
	     );
    
	}
	$arResult = array( 'infoList' => $commentsarray );
	$this->IncludeComponentTemplate();
	}


