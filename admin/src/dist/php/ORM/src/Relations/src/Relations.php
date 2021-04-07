<?php
namespace DATABASE\ORM\Relations\BaseTraits;
if (!trait_exists('DATABASE\ORM\Relations\BaseTraits\Relations')){
    trait Relations {
        use RelationQuerying;
        final public function relate() {
            return new self();
        }

        public function __toString() {
            return 'relations';
        }


    }
}
