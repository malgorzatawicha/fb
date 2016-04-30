<?php

/**
 * make json encoded string from eloquent model.
 * Workaround for case: eloquent model has double qoute - output should be still correct json.
 * 
 * @param \Illuminate\Database\Eloquent\Model $object
 * @return string
 */
function escapeJson(Illuminate\Database\Eloquent\Model $object)
{
    $array = $object->toArray();
    $escapedArray = escapeJsonRow($array);
    return json_encode($escapedArray);
}

/**
 * Helper function for escapeJson.
 * @param $data
 * @return array|string
 */
function escapeJsonRow($data)
{
    if (is_array($data)) {
        $result = [];
        foreach ($data as $key => $value) {
            $result[$key] = escapeJsonRow($value);
        }
        return $result;
    } else {
        return htmlentities(html_entity_decode($data), ENT_NOQUOTES, 'UTF-8', false);
    }
}