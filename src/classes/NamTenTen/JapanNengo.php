<?php

namespace NamTenTen\classes;


/**
 * 
 */
class JapanNengo
{
	// https://ja.wikipedia.org/wiki/%E5%85%83%E5%8F%B7%E4%B8%80%E8%A6%A7_(%E6%97%A5%E6%9C%AC)
	private $nengo_years			= [
		'meiji' 				=> [
			'nengo' 			=> '明治',
			'nengo_kana' 		=> 'めいじ',
			'start' 			=> [
				'year' 			=> 1868,
				'month' 		=> 1,
				'day' 			=> 25,
			],
			'end' 				=> [
				'year' 			=> 1912,
				'month' 		=> 7,
				'day' 			=> 29,
			],
			'start_date' 		=> 18680125,
			'end_date' 			=> 19120729,
		],

		'taishou' 				=> [
			'nengo' 			=> '大正',
			'nengo_kana' 		=> 'たいしょう',
			'start' 			=> [
				'year' 			=> 1912,
				'month' 		=> 7,
				'day' 			=> 30,
			],
			'end' 				=> [
				'year' 			=> 1926,
				'month' 		=> 12,
				'day' 			=> 24,
			],
			'start_date' 		=> 19120730,
			'end_date' 			=> 19261224,
		],

		'shouwa' 				=> [
			'nengo' 			=> '昭和',
			'nengo_kana' 		=> 'しょうわ',
			'start' 			=> [
				'year' 			=> 1926,
				'month' 		=> 12,
				'day' 			=> 25,
			],
			'end' 				=> [
				'year' 			=> 1989,
				'month' 		=> 1,
				'day' 			=> 7,
			],
			'start_date' 		=> 19261225,
			'end_date' 			=> 19890107,
		],

		'heisei' 				=> [
			'nengo' 			=> '平成',
			'nengo_kana' 		=> 'へいせい',
			'start' 			=> [
				'year' 			=> 1989,
				'month' 		=> 1,
				'day' 			=> 8,
			],
			'end' 				=> [
				'year' 			=> 2019,
				'month' 		=> 4,
				'day' 			=> 30,
			],
			'start_date' 		=> 19890108,
			'end_date' 			=> 20190430,
		],

		'reiwa' 				=> [
			'nengo' 			=> '令和',
			'nengo_kana' 		=> 'れいわ',
			'start' 			=> [
				'year' 			=> 2019,
				'month' 		=> 5,
				'day' 			=> 1,
			],
			'end' 				=> NULL,
			'start_date' 		=> 20190501,
			'end_date' 			=> NULL,
		],

	];

	public function toNengoYear($western_date = 20191107)
	{
		$prev_era_year = reset($this->nengo_years);
		foreach ($this->nengo_years as $key => $era_year) {
			if($era_year['start_date'] <= $western_date){
				$prev_era_year = $era_year;
			}else{
				break;
			}
		}

		$western_year 		= (($western_date - ($western_date % 10000)) / 10000);

		$era_year = $western_year - $prev_era_year["start"]['year'] + 1;
		$era_year = $prev_era_year['nengo'] . $era_year;

		return $era_year;
	}

	public function toNengoArray($western_date = 20191107)
	{
		$prev_era_year = reset($this->nengo_years);
		foreach ($this->nengo_years as $key => $era_year) {
			if($era_year['start_date'] <= $western_date){
				$prev_era_year = $era_year;
			}else{
				break;
			}
		}

		$western_day 		= ($western_date % 100);
		$western_month 		= ((($western_date % 10000) - $western_day) / 100);
		$western_year 		= (($western_date - ($western_date % 10000)) / 10000);

		$era_year = $western_year - $prev_era_year["start"]['year'] + 1;
		$era = $prev_era_year;

		$era['custom']['western_date'] 		= $western_date;
		$era['custom']['western_year'] 		= $western_year;

		$era['custom']['year'] 		= $era_year;
		$era['custom']['month'] 	= $western_month;
		$era['custom']['day'] 		= $western_day;

		return $era;
	}

	public function donateUrl()
	{
		return "https://www.paypal.me/rakujin";
	}

}
