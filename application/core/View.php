<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 02.05.2017
 * Time: 16:07
 */
class View
{
    function generate($contentView, $templateView, $data = null)
    {
        /*
		динамически подключаем общий шаблон (вид),
		внутри которого будет встраиваться вид
		для отображения контента конкретной страницы.
		*/
        include ROOT . '/application/views/'.$templateView;
    }
}