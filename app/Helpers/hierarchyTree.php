<?php
use Illuminate\Support\Collection;
function createTree(Collection $collection, $selectedNode = null, $field = 'id')
{
    if ($collection->isEmpty()) {
        return json_encode([]);
    }

    $array = [];
    foreach ($collection as $node) {
        $array[] = collectTree($node, $selectedNode, $field);
    }

    return json_encode($array);
}

function collectTree($node, $selectedNode = null, $field = 'id') {
    $nodeData = [
        'text' => $node->name,
        'id' => $node->$field,
        'state' => [
            'selected' => !empty($selectedNode) &&($node->getKey() == $selectedNode->getKey())
        ]
    ];
    if( $node->isLeaf() ) {
        return $nodeData;
    } else {
        foreach ($node->children as $child) {
            $nodeData['nodes'][] = collectTree($child, $selectedNode, $field);
        }
        return $nodeData;
    }
}