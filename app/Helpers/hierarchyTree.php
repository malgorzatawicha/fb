<?php
use Illuminate\Support\Collection;

function createTree(Collection $collection, $selectedNode = null)
{
    $tree = new Tree($collection, $selectedNode);
    return $tree->createTree();
}

function createFrontTree(Collection $collection, $page, $selectedNode = null)
{
    $tree = new FrontTree($collection, $page, $selectedNode);
    return $tree->createTree();
}

function createMobileFrontTree(Collection $collection, $page, $selectedNode = null)
{
    $tree = new MobileFrontTree($collection, $page, $selectedNode);
    return $tree->createTree();
}

class Tree
{
    protected $selectedNode;
    protected $collection;

    public function __construct(Collection $collection, $selectedNode = null)
    {
        $this->collection = $collection;
        $this->selectedNode = $selectedNode;
    }

    public function createTree()
    {
        if ($this->collection->isEmpty()) {
            return json_encode([]);
        }

        $array = [];
        foreach ($this->collection as $node) {
            $array[] = $this->collectTree($node);
        }
        return json_encode($array);
    }

    protected function collectTree($node)
    {
        $nodeData = $this->collectNodeData($node);
        if( $node->isLeaf() ) {
            return $nodeData;
        } else {
            foreach ($node->children as $child) {
                $nodeData['nodes'][] = $this->collectTree($child);
            }
            return $nodeData;
        }
    }

    protected function collectNodeData($node)
    {
        return [
            'text' => $node->title,
            'id' => $node->getKey(),
            'state' => [
                'selected' => !empty($this->selectedNode) && ($node->getKey() == $this->selectedNode->getKey()),
                'expanded' => !empty($this->selectedNode) && ($node->isAncestorOf($this->selectedNode)),
            ]
        ];
    }
}

class FrontTree extends Tree
{
    protected $page;
    public function __construct(Collection $collection, $page, $selectedNode)
    {
        parent::__construct($collection, $selectedNode);
        $this->page = $page;
    }

    protected function collectNodeData($node)
    {
        $data = parent::collectNodeData($node);
        $data['id'] = $node->slug;
        $data['href'] = route('gallery', ['pages' => $this->page->slug, 'category' => $node->slug]);

        $data['state'] = [
            'selected' => !empty($this->selectedNode) && ($node->getKey() == $this->selectedNode->getKey()),
            'expanded' => ($node->getDepth() <= 1 || !empty($this->selectedNode) && ($node->isAncestorOf($this->selectedNode))),
        ];
        return $data;
    }
}

class MobileFrontTree extends FrontTree
{
    protected function collectNodeData($node)
    {
        $data = parent::collectNodeData($node);
        $data['selectable'] = false;
        $data['state'] = [
            'selectable' => false,
            'selected' => !empty($this->selectedNode) && ($node->isAncestorOf($this->selectedNode) || $node->getKey() == $this->selectedNode->getKey()),
        ];

        return $data;
    }
}