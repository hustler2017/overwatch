<?php
/**
 * Created by Averin Ilya.
 * Date: 29.04.2018
 * Project: overwatch
 */

function parseFreelanceru($html = ''){

	$document = phpQuery::newDocument($html);
	$links = $document->find('a.ptitle');
	$items = [];
	foreach($links as $link){

		$href = "https://www.fl.ru".pq($link)->attr('href');


		$id = (int)substr($href,-11,6);
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