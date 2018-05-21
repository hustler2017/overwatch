<?php

/**
 * Created by Averin Ilya.
 * Date: 21.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
class Freelance extends Parser
{
	public $domain = 'https://freelance.ru';
	public $anchor = '.proj a.ptitle';

	public function get($query)
	{
		$html = parent::get($query);
		$html = iconv('windows-1251', 'utf-8', $html);
		return $html;
	}

	public function parseItem($anchor)
	{
		$href = $this->domain.pq($anchor)->attr('href');
		$id = (int)substr($href,-11,6);
		$title =  $anchor->nodeValue;

		return [
			'id' => $id,
			'title' => $title,
			'href' => $href,
			'time' => '',
			'description' => ''
		];
	}
}