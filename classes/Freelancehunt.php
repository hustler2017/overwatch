<?php

/**
 * Created by Averin Ilya.
 * Date: 21.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
class Freelancehunt extends Parser
{
	public $domain = 'https://freelancehunt.com';
	public $anchor = '#projects-html tr[data-published]';

	public function parseItem($anchor)
	{

		$item = [];
		$item['time'] = pq($anchor)->attr('data-published');
		$a = pq($anchor)->find("a.visitable");
		$item['href'] = $a->attr('href');

		if(preg_match('/(\d+)\.html$/', $item['href'], $matches)){
			$item['id'] = $matches[1];
		} else {
			return false;
		}

		$item['title'] = $a->elements[0]->nodeValue;

		return $item;
	}
}