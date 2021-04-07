<?php
namespace DATABASE\ORM\Relations\BaseTraits;
use DATABASE\ORM\Relations\BaseClasses\BaseRelationClass;
use DATABASE\ORM\Relations\BaseClasses\RelationTypes;

if (!trait_exists('DATABASE\ORM\Relations\BaseTraits\RelationQuerying')) {
    trait RelationQuerying {
        private $relations = [];

        public function LeftJoin(string $tableName, string $as) {
            return new BaseRelationClass(RelationTypes::LeftJoin,$tableName,$as);
        }
    }
}
