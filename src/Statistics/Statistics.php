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
        return min((array) $this);
    }

    public function max()
    {
        return max((array) $this);
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