<?php

function getAll($tbl)
{
    include 'connect.php';

    $queryAll = 'SELECT * FROM ' . $tbl;
    // var_dump($queryAll);
    // exit;
    $runAll = $pdo->query($queryAll);
    if ($runAll) {
        return $runAll;
    } else {
        $error = 'There was a problem accessing this info';
        return $error;
    }

}
function getSingle($tbl, $col, $value)
{
    include 'connect.php';
    $querySingle = 'SELECT * FROM ' . $tbl . ' WHERE ' . $col . '=' . $value;
    $runSingle = $pdo->query($querySingle);
    // var_dump($querySingle);
    if ($runSingle) {
        return $runSingle;
    } else {
        $error = 'There was a problem';
        return error;
    }
}

function filterResults($tbl, $tbl_2, $tbl_3, $col, $col_2, $col_3, $filter)
{
    include 'connect.php';
    $filterQuery = 'SELECT * FROM ' . $tbl . ' as a, ';
    $filterQuery .= $tbl_2 . ' as b, ';
    $filterQuery .= $tbl_3 . ' as c ';
    $filterQuery .= 'WHERE a.' . $col . ' = c.' . $col;
    $filterQuery .= ' AND b.' . $col_2 . ' = c.' . $col_2;
    $filterQuery .= ' AND b.' . $col_3 . '= "' . $filter . '"';
    // $filterQuery = "SELECT * FROM :tbl  as a, :tbl_2 as b, :tbl_3 as c, WHERE a :col = c :col AND b :col_2 = c :col_2 AND b :col_3 = :filter";
    // var_dump($filterQuery);
    // SELECT * FROM tbl_product as a, tbl_category as b, tbl_prod_cat as c WHERE a.product_id = c.product_id AND b.cat_id = c.cat_id AND b.cat_name="Footware & Shoes"
    $runQuery = $pdo->query($filterQuery);
    if ($runQuery) {
        return $runQuery;
    } else {
        $error = 'There was a problem';
        return $error;
    }

}
