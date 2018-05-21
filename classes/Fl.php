<?php

/**
 * Created by Averin Ilya.
 * Date: 21.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
class Fl extends Parser
{
	public $domain = 'https://www.fl.ru';
	public $anchor = 'a.b-post__link';

	public function get($query)
	{
		$context = stream_context_create(array(
			'http'=>array(
				'method'=>"GET",
				'header'=>"Accept-language: ru\r\n" .
					"User-Agent:    Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36\r\n"
			)
		));

		$html = file_get_contents($this->domain.$query['query_string'], false, $context);

		return $html;
	}

	public function parseItem($anchor)
	{
		$href = $this->domain.pq($anchor)->attr('href');
		$id = pq($anchor)->attr('id');
		$id = (int)substr($id,-7,7);
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