<?php

/**
 * Created by PhpStorm.
 * User: davidbondukupieme
 * Date: 22/10/15
 * Time: 17:43
 */
class CoreModel
{
    static function getAll()
    {
        return "Je suis avec Ibrahim, nous bossons sur PHP en version Pro";
    }

    static function getUserId()
    {
        return uniqid();
    }
}