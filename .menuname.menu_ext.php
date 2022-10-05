<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if(CModule::IncludeModule("iblock")){

    $aMenuLinksExt = [];
    $db = CIBlockSection::GetList(
        array("SORT" => "ASC"),
        array(
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => 5,
            'DEPTH_LEVEL' => '1'
        )
    );

    while ($link = $db->GetNext()) {
        $aMenuLinksExt[] = [
            $link['NAME'],
            $link['SECTION_PAGE_URL']
        ];
    }

    $aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
}
