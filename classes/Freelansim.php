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
	public $targets = [
		'/tasks?categories=development_all_inclusive,development_backend,development_frontend,development_prototyping,development_ios,development_android,development_desktop,development_bots,development_games,development_1c_dev,development_scripts,development_other,testing_sites,testing_mobile,testing_software,admin_servers,admin_network,admin_databases,admin_security,admin_other,design_sites,design_landings,design_logos,design_illustrations,design_mobile,design_icons,design_polygraphy,design_banners,design_graphics,design_corporate_identity,design_presentations,design_modeling,design_animation,design_photo,design_other,content_copywriting,content_rewriting,content_audio,content_article,content_scenarios,content_naming,content_correction,content_translations,content_coursework,content_specification,content_management,content_other,marketing_smm,marketing_seo,marketing_context,marketing_email,marketing_research,marketing_sales,marketing_pr,marketing_other,other_audit_analytics,other_consulting,other_jurisprudence,other_accounting,other_audio,other_video,other_engineering,other_other'
	];
	public $update_time = 30; // сек

	public function parsePublishedString($string)
	{
		$matches = [];
		if(preg_match('/(\d+) (час|часов)/', $string, $matches) ){
			$time = time() - (int)$matches[1]*60*60;
		} elseif(preg_match('/(\d+) (день|дня|дней)/', $string, $matches) ){
			$time = time() - (int)$matches[1]*60*60*24;
		} elseif(preg_match('/(\d+) (минут|минуты|минута)/', $string, $matches)) {
			$time = time() - (int)$matches[1]*60;
		} else {
			return false;
		}

		return $time;
	}

	public function parseItem($anchor)
	{
		$linkElem = pq($anchor);
		$parent = $linkElem->parent()->parent();
		$publishedElem = $parent->find('.params__published-at');
		$publishedString = $publishedElem->html();
		$published = $this->parsePublishedString($publishedString);

		if($published === false)
			return false;

		$href = $this->domain.$linkElem->attr('href');
		pq($anchor)->attr('href', $href);
		pq($anchor)->attr('target',"_blank");
		$title = $anchor->nodeValue;

		return [
			'domain' => 'freelansim',
			'url' => $href,
			'title' => $title,
			'published' => date( "Y-m-d H:i:s" ,$published),
			'founded' => date("Y-m-d H:i:s", time() ),
			'description' => ''
		];

	}
}