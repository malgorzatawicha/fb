<?php namespace Fb\Services;

use Baum\Extensions\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection as BaseCollection;

class HierarchicalCollection extends Collection
{
    public function toActiveHierarchy() {
        $dict = $this->getDictionary();

        // Enforce sorting by $orderColumn setting in Baum\Node instance
        uasort($dict, function($a, $b){
            return ($a->getOrder() >= $b->getOrder()) ? 1 : -1;
        });

        return new BaseCollection($this->activeHierarchical($dict));
    }

    protected function activeHierarchical($result) {
        return $this->clearInactive($this->hierarchical($result));
    }

    private function clearInactive($nodes) {
        if ($nodes instanceof Model) {
            if (!$nodes->active) {
                return null;
            }
            if (count($nodes->children) > 0) {

                foreach ($nodes->children as $key => $child) {
                    $result = $this->clearInactive($child);
                    if (!$result) {
                        unset($nodes->children[$key]);
                    } else {
                        $nodes->children[$key] = $result;
                    }
                }
            }
            return $nodes;
        } else {
            $result = [];
            foreach ($nodes as $key => $node) {
                $result[$key] = $this->clearInactive($node);
            }
            return $result;
        }
    }
}