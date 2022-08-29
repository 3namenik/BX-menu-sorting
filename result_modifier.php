<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();


$new_arr = [];

foreach ($arResult as $key => &$item) {
    $item['ID'] = $key;
}

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