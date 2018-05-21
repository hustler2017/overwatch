<?php

/**
 * Created by Averin Ilya.
 * Date: 21.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
class Freelansim extends Parser
{
	public $domain = 'https://freelansim.ru';
	public $anchor = '.task__title > a';

	public function parseItem($anchor)
	{
		$href = $this->domain.pq($anchor)->attr('href');
		pq($anchor)->attr('href', $href);
		pq($anchor)->attr('target',"_blank");
		$id = (int)substr($href,-6,6);
		$title = $anchor->nodeValue;

		return [
			'id' => $id,
			'title' => $title,
			'href' => $href,
			'time' => '',
			'description' => ''
		];
	}
}