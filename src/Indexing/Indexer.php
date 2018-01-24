<?php

namespace numphp\Indexing;

use numphp\operator;
use numphp\Slicing\Slice;
use numphp\Indexing\StringIndexer;

trait Indexer
{
    /**
     * ArrayAccess methods
     */

    public function offsetSet($offset, $value) 
    {
        // masking
        if (is_array($offset) || $offset instanceof $this)
        {
            foreach ($this->getIndexes($offset) as $index)
                parent::offsetSet($index, $value);

            return;
        }

        // slicing
        if(Slice::isValidFormat($offset))
        {
            list($start, $stop, $step) = Slice::getOffsets($this, $offset);

            for ($i=$start; $i < $stop; $i += $step)
                parent::offsetSet($i, $value);
            
            return;
        }
        
        //use base offsetSet
        parent::offsetSet($offset, $value);
    }

    public function offsetGet($offset) 
    {
        // masking
        if (is_array($offset) || $offset instanceof $this)
        {
            $result = [];

            foreach ($this->getIndexes($offset) as $index)
                $result[] = parent::offsetGet($index);

            return new self($result);
        }

        // slicing
        if(Slice::isValidFormat($offset))
            return Slice::slice($this, $offset);

        // base offsetGet
        if(is_numeric($offset))
            return parent::offsetGet($offset);


        // use string indexer
        $stringIndexer = new StringIndexer($offset);
        $callee = $stringIndexer->convertToMethod();

        return $this->{$callee['method']}($callee['arg']);
    }

    /**
     * Get array indexes according to conditions
     * @param  mixed  $offset could be array of indexes or array of booleans
     * @return array         
     */
    private function getIndexes($offset)
    {
        $indexes = [];

        // no offset - no indexes
        if (empty($offset))
            return [];

        // offset is an array of indexes already
        if (!is_bool($offset[0]))
            return $offset;

        // convert mask array to array of indexes
        foreach ($offset as $index => $value)
        {
            if ($value)
                $indexes[] = $index;
        }
        
        return $indexes;
    }
}
