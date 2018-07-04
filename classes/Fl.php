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
	public $anchor = 'h2 > a.b-post__link';//'a.b-post__link';
	public $targets = [
		'/projects/'
	];

	public $last_html = '';


	public function isForEveryone($string){
		if(preg_match('/Для всех/', $string)){
			return true;
		}
		return false;
	}

	public function get($query)
	{
		$context = stream_context_create(array(
			'http'=>array(
				'method'=>"GET",
				'header'=>"Accept-language: ru\r\n" .
					"User-Agent:    Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36\r\n"
			)
		));

		$html = file_get_contents($this->domain.$query, false, $context);
		$html = str_replace( array(
			"<script type=\"text/javascript\">document.write('",
			"');</script>",
			"</script>"
		) , '', $html);

		$this->last_html = $html;

		return $html;
	}

	public function parseDate($date_string)
	{
		$matches = [];
		if(preg_match('/(\d+) (часов|часа|час) (\d+) (минуту|минут|минуты) назад/', $date_string, $matches)){
			$hours = intval($matches[1]);
			$minutes = intval($matches[3]);
			$offset = (($hours * 60) + $minutes) * 60;
		} elseif(preg_match('/(\d+) (минуту|минут|минуты) назад/', $date_string, $matches)){
			$minutes = intval($matches[1]);
			$offset = $minutes * 60;
		} elseif(preg_match('/Только что/', $date_string, $matches)){
			$offset = 0;
		} else {
			return false;
		}

		$published = date("Y-m-d H:i:s", time() - $offset);

		return $published;
	}


	public function parseItem($anchor)
	{

		$link = pq($anchor);
		$href = $link->attr('href');
		$title = $link->html();

		$container = $link->parent()->parent();
		if($container->length){
			$to_parser = $container->get(0)->textContent;
		} else {
			return false;
		}

		// только общедоступные задания
		if(false === $this->isForEveryone($to_parser))
			return false;

		$published = $this->parseDate($to_parser);
		if($published === false)
		{
			return false;
		}



		return [
			'domain' => 'fl',
			'url' => $href,
			'title' => $title,
			'published' => $published,
			'founded' => date("Y-m-d H:i:s", time() ),
			'description' => ''
		];
	}
}