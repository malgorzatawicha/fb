<?php
use Illuminate\Support\Collection;
function createTree(Collection $collection, $selectedNode = null)
{
    if ($collection->isEmpty()) {
        return json_encode([]);
    }

    $array = [];
    foreach ($collection as $node) {
        $array[] = collectTree($node, $selectedNode);
    }

    return json_encode($array);
}

function collectTree($node, $selectedNode = null) {
    $nodeData = [
        'text' => $node->name,
        'id' => $node->getKey(),
        'state' => [
            'selected' => !empty($selectedNode) &&($node->getKey() == $selectedNode->getKey())
        ]
    ];
    if( $node->isLeaf() ) {
        return $nodeData;
    } else {
        foreach ($node->children as $child) {
            $nodeData['nodes'][] = collectTree($child, $selectedNode);
        }
        return $nodeData;
    }
}