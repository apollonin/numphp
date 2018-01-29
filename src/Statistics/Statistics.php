<?php

namespace numphp\Statistics;

trait Statistics
{
    public function mean()
    {
        return $this->sum() / $this->countAll();
    }

    public function median()
    {
        // Flatten matrix for median calculation
        $sorted = $this->dimensions > 1 ? (array) $this->flatten() : (array) $this;

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
        $sum = 0;

        array_walk_recursive(($this->getArrayCopy()), function($item) use (&$sum) {
            $sum += $item;
        });

        return $sum;
    }

    public function countAll()
    {
        $count = 0;

        array_walk_recursive(($this->getArrayCopy()), function($item) use (&$count) {
            $count++;
        });

        return $count;
    }


    public function describe()
    {
        return [
            'count'  => $this->countAll(),
            'max'    => $this->max(),
            'mean'   => $this->mean(),
            'median' => $this->median(),
            'min'    => $this->min(),
            'sum'    => $this->sum(),
        ];
    }
}