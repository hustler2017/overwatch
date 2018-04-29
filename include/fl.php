<?php
/**
 * Created by Averin Ilya.
 * Date: 29.04.2018
 * Project: overwatch
 */

function parseFl($html = ''){

	$document = phpQuery::newDocument($html);
	$links = $document->find('a.b-post__link');
	$items = [];
	foreach($links as $link){

		$href = "https://www.fl.ru".pq($link)->attr('href');

		$id = pq($link)->attr('id');
		$id = (int)substr($id,-7,7);
		$title = $link->nodeValue;

		$items[] = [
			'id' => $id,
			'title' => $title,
			'href' => $href,
			'time' => '',
			'description' => ''
		];
	}

	return $items;
}