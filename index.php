<?php

$list = new np_array([18, 25, 26, 30, 34]);

var_dump($list[operator::b_and($list->gt(25), $list->lt(30))]);