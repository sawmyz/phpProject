<?php declare(strict_types=1);

namespace DOMWrap\Traits;

use DOMWrap\NodeList;

/**
 * Node Trait
 *
 * @property \DOMDocument $ownerDocument
 */
trait NodeTrait
{
    /**
     * @return NodeList
     */
    public function collection(): NodeList {
        return $this->newNodeList([$this]);
    }

    /**
     * @return \DOMDocument
     */
    public function document(): ?\DOMDocument {
        if ($this->isRemoved()) {
            return null;
        }

        return $this->ownerDocument;
    }

    /**
     * @param NodeList $nodeList
     *
     * @return NodeList|\DOMNode|null
     */
    public function result(NodeList $nodeList) {
        if ($nodeList->count()) {
            return $nodeList->first();
        }

        return null;
    }
}