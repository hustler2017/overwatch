<?php
/**
 * Created by Averin Ilya.
 * Date: 29.04.2018
 * Project: overwatch
 */

function parseFreelancehunt($html = ''){

	$document = phpQuery::newDocument($html);
	$links = $document->find('a.bigger');


	$items = [];
	foreach($links as $link){

		$href = "https://freelancehunt.com".pq($link)->attr('href');
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
