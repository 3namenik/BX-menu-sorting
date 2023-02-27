<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (! function_exists("array_key_last")) {
    function array_key_last($array) {
        if (!is_array($array) || empty($array)) {
            return NULL;
        }
       
        return array_keys($array)[count($array)-1];
    }
}

$new_arr = [];

foreach ($arResult as $key => &$item) {
    $item['ID'] = $key;
}

/* Если bitrix.menu */
foreach ($arResult as $key => &$item) {
    if ($item['DEPTH_LEVEL'] == 1) {
        $new_arr[$item['ID']] = $item;
    } elseif ($item['DEPTH_LEVEL'] == 2) {
        $new_arr[array_key_last($new_arr)]['CHILD'][$item['ID']] = $item;
    } else {
        $new_arr[array_key_last($new_arr)]['CHILD'][$item['ID']]['CHILD'][array_key_last($new_arr[array_key_last($new_arr)]['CHILD'])][$item['ID']] = $item;
    }
}

$arResult = $new_arr;

/* Если catalog.section.list */
foreach ($arResult['SECTIONS'] as $key => &$item) {
	if ($item['DEPTH_LEVEL'] == 1) {
		$new_arr[$item['ID']] = $item;
	} elseif ($item['DEPTH_LEVEL'] == 2) {
		$new_arr[array_key_last($new_arr)]['CHILD'][$item['ID']] = $item;
	} else {
		$new_arr[array_key_last($new_arr)]['CHILD'][$item['IBLOCK_SECTION_ID']]['CHILD'][$item['ID']] = $item;
	}
}

$arResult = $new_arr;

