<?php

use App\Models\Column;

define('PAGINATION_COUNT', 10);

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    return $filename;
}

function deletePhotos($image_link)
{
    $image = \Illuminate\Support\Str::after($image_link, 'assets/');
    $image = public_path('assets/' . $image);
    unlink($image);
}

function getChildren($columnId) {
    $column = Column::with(['childrens_sum' => function($q) {
        $q->select('id', 'parent_id_sum');
    }])->find($columnId);
    return $column;
}
function getCountOfAvgChildren($columnId) {
    $column = Column::with('childrens_avg')->find($columnId);
    return $column->childrens_avg->count();
}


