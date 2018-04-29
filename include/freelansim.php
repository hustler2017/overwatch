<?php
/**
 * Created by Averin Ilya.
 * Date: 29.04.2018
 * Project: overwatch
 */

function parseFreelansim($html = ''){

	$document = phpQuery::newDocument($html);
	$links = $document->find('.task__title > a');
	$items = [];
	foreach($links as $link){

		$href = "https://freelansim.ru".pq($link)->attr('href');
		pq($link)->attr('href', $href);
		pq($link)->attr('target',"_blank");
		$id = (int)substr($href,-6,6);
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