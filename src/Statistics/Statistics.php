<?php

namespace numphp\Statistics;

trait Statistics
{
    public function mean()
    {
        return array_sum((array) $this) / count($this);
    }

    public function median()
    {
        $sorted = (array) $this;

        sort($sorted, SORT_NUMERIC);

        $count = count($this);
        
        $middle = (int) ($count / 2);

        if ($count % 2 == 0)
            return ($sorted[$middle] + $sorted[$middle - 1]) / 2;

        return $sorted[$middle];

    }

    public function min()
    {
        $min = INF;

        array_walk_recursive(($this->getArrayCopy()), function($item) use (&$min) {
            if ($item < $min)
                $min = $item;
        });

        return $min;
    }

    public function max()
    {
        $max = -INF;

        array_walk_recursive(($this->getArrayCopy()), function($item) use (&$max) {
            if ($item > $max)
                $max = $item;
        });

        return $max;
    }

    public function sum()
    {
        return array_sum((array) $this);
    }


    public function describe()
    {
        return [
            'count'  => count($this),
            'max'    => $this->max(),
            'mean'   => $this->mean(),
            'median' => $this->median(),
            'min'    => $this->min(),
            'sum'    => $this->sum(),
        ];
    }
}