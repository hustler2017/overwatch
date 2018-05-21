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
	public $anchor = 'a.bigger';

	public function parseItem($anchor)
	{
		$href = $this->domain.pq($anchor)->attr('href');
		$id = (int)substr($href,-11,6);
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