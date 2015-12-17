<?php

function createTree(\Illuminate\Support\Collection $collection)
{
    if ($collection->isEmpty()) {
        return json_encode([]);
    }

    $array = [];
    foreach ($collection as $node) {
        $array[] = collectTree($node);
    }

    return json_encode($array);
}

function collectTree($node) {
    if( $node->isLeaf() ) {
        return ['text' => $node->name, 'id' => $node->getKey()];
    } else {
        $array = ['text' => $node->name, 'id' => $node->getKey()];
        foreach ($node->children as $child) {
            $array['nodes'][] = collectTree($child);
        }
        return $array;
    }
}