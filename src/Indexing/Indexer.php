<?php

namespace numphp\Indexing;

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
            foreach ($this->getIndexes($offset) as $level => $offsets)
            {
                if (is_array($offsets))
                {
                    foreach ($offsets as $index)
                        $this[$level][$index] = $value;
                }
                else
                {
                    parent::offsetSet($offsets, $value);
                }
            }

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
        // multiply indexes or masking
        if (is_array($offset) || $offset instanceof $this)
        {
            $result = [];

            foreach ($this->getIndexes($offset) as $level => $offsets)
            {
                if (is_array($offsets))
                {
                    foreach ($offsets as $index)
                        $result[] = $this[$level][$index];
                }
                else
                {
                    $result[] = $this[$offsets];
                }
            }

            return new self($result);   
        }

        // slicing
        if(Slice::isValidFormat($offset))
            return Slice::slice($this, $offset);

        // base offsetGet
        if(is_numeric($offset))
            return parent::offsetGet($offset);


        // use string indexer
        return $this->getStringOffset($offset);
    }

    public function mask($offset)
    {
        return $this->getStringOffset($offset);
    }

    public function getArrayCopy()
    {
        $result = [];

        foreach ($this as $item)
        {
            if ($item instanceof $this)
                $result[] = $item->getArrayCopy();
            else
                return (array) $this;
        }

        return $result;
    }

    private function getStringOffset($offset)
    {
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

        // convert mask array to array of indexes
        foreach ($offset as $index => $value)
        {
            if ($value instanceof $this)
            {
                $indexes[] = $this->getIndexes($value);
            }
            elseif ($value === true || $value === false)
            {
                if ($value)
                    $indexes[] = $index;
            }
            else
            {
                $indexes[] = $value;   
            }
        }
        
        return $indexes;
    }
}
