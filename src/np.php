<?php

namespace numphp;

use numphp\np_array;

class np
{
    /**
     * Concatenate two or more np_arrays
     * @param  list of np_arrays
     * @return np_array          
     */
    public static function concatenate()
    {
        $arrays = func_get_args();

        $result = [];
        $allowed_shape = null;

        foreach ($arrays as $array)
        {
            if (!$array instanceof np_array)
                throw new \Exception("Each array should be instance of np_array");

            // validate shape
            if (!$allowed_shape)
            {
                $allowed_shape = $array->shape;
                unset($allowed_shape[0]);
            }
            else
            {
                $current_shape = $array->shape;
                unset($current_shape[0]);

                if ($current_shape != $allowed_shape)
                    throw new \Exception("All the input arrays must have same number of dimensions");
            }

            foreach ($array as $elem) 
            {
                $result[] = $elem;
            }
        }

        return new np_array($result);
    }
}