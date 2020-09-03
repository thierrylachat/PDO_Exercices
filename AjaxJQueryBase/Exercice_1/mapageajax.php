<?php

    //$id = $_POST["id"];
    //$categorie = $_POST["categorie"];

    $element1 = array();
    $element1["id"] = 1;
    $element1["categorie"] = "Mac";

    $element2 = array();
    $element2["id"] = 2;
    $element2["categorie"] = "Windows";

    $mesElements = array();
    $mesElements[0] = $element1;
    $mesElements[1] = $element2;

echo json_encode($mesElements);
