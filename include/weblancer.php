<?php
/**
 * Created by Averin Ilya.
 * Date: 29.04.2018
 * Project: overwatch
 */

function parseWeblancer($html = ''){

	$document = phpQuery::newDocument($html);

	$links = $document->find('h2 > a.text-bold.show_visited');


	$items = [];
	foreach($links as $link){

		$href = "https://www.weblancer.net".pq($link)->attr('href');
		pq($link)->attr('href', $href);
		pq($link)->attr('target',"_blank");
		$id = (int)substr($href,-7,6);
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