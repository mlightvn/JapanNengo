<?php

namespace NamTenTen;

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
		if(is_string($western_date)){
			$western_date = str_replace(["/", "-"], "", $western_date);
		}
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
		$era_year = $prev_era_year['nengo'] . ($era_year == 1 ? "元" : $era_year) . "年";

		return $era_year;
	}

	public function toNengoDate($western_date = 20191107)
	{
		if(is_string($western_date)){
			$western_date = str_replace(["/", "-"], "", $western_date);
		}
		$date_arr = $this->toNengoArray($western_date);
		$nengo_year = $date_arr['custom']['year'];
		$date_str = $date_arr["nengo"] . ($nengo_year == 1 ? "元" : $nengo_year) . "年" . $date_arr['custom']['month'] . "月" . $date_arr['custom']['day'] . "日";

		return $date_str;
	}

	public function toNengoArray($western_date = 20191107)
	{
		if(is_string($western_date)){
			$western_date = str_replace(["/", "-"], "", $western_date);
		}
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
		$era['custom']['month'] 	= str_pad($western_month, 2, "0", STR_PAD_LEFT);
		$era['custom']['day'] 		= str_pad($western_day, 2, "0", STR_PAD_LEFT);

		return $era;
	}

	public function toDateArray($wareki_date = "令和元年11月07日")
	{
		$wareki_date 		= str_replace("元", "1", $wareki_date); 			// 令和1年11月07日
		$wareki_date 		= str_replace("月", "/", $wareki_date); 			// 令和1年11/07日
		$wareki_date 		= str_replace("日", "", $wareki_date); 			// 令和1年11/07
		$wareki_date_arr 	= explode("年", $wareki_date); 					// ["令和1", "11/07"]
		$wareki_year 		= reset($wareki_date_arr); 						// 令和1
		$month_day 			= end($wareki_date_arr); 						// 11/07
		$month_day_arr 		= explode("/", $month_day); 					// [11,07]
		$month 				= reset($month_day_arr); 						// 11
		$day 				= end($month_day_arr); 							// 07

		$date = null;

		preg_match("/(.+?)(\d+)/", $wareki_year, $nengo_arr); 		// ["令和1", "令和", 1]
		if(count($nengo_arr) > 2){
			$nengo_arr['nengo'] = $nengo_arr[1]; 					// 令和
			$nengo_arr['nengo_number'] = $nengo_arr[2]; 			// 1

			foreach ($this->nengo_years as $key => $wareki) {
				if($wareki['nengo'] === $nengo_arr['nengo']){
					$nengo_arr["nengo_info"] 			= $wareki;
					$year 								= $wareki["start"]["year"] + $nengo_arr['nengo_number'] - 1; 		// 2019 + 1 - 1 = 2019
					$nengo_arr["date"]["year"] 			= $year; 							// 2019
					$nengo_arr["date"]["month_day"] 	= $month_day; 						// 11/07
					$nengo_arr["date"]["month"] 		= $month; 							// 11
					$nengo_arr["date"]["day"] 			= $day; 							// 07
					$date 								= $year . "/" . $month_day; 		// 2019/11/07
					$nengo_arr["date"]["date"] 			= $date;
					break;
				}
			}
		}

		return $nengo_arr;
	}

	/**
	 * [toDate description]
	 * @param  string $nengo_date, 和暦 format. E.g: 令和元年11月07日
	 * @return [string]          , date string by YYYY/MM/DD format
	 */
	public function toDate($wareki_date = "令和元年11月07日")
	{
		$nengo_arr = $this->toDateArray($wareki_date);
		return ($nengo_arr["date"]["date"] ?? null);
	}

	public function toYear($wareki_date = "令和元年11月07日")
	{
		$nengo_arr = $this->toDateArray($wareki_date);
		return ($nengo_arr["date"]["year"] ?? null);
	}

	public function donateUrl()
	{
		return "https://www.paypal.me/rakujin";
	}

	public function author()
	{
		$author = new \stdClass();

		$author->name 				= "Nguyen Ngoc Nam";
		$author->furigana 			= "グエン　ゴック　ナム";
		$author->role 				= "Developer";
		$author->social_urls 		= [
			"linkedIn" 				=> "https://www.linkedin.com/in/nguyenngocnam/",
			"github" 				=> "https://github.com/namtenten",
			"stackoverflow" 		=> "https://stackoverflow.com/users/6351894/ngoc-nam",
		];
		$author->nationality 		= "Vietnamese";
		$author->living 			= "Japan, Tokyo";
		$author->languages 			= [
			["language" 	=> "Vietnamese"		, "level" 	=> "Native"],
			["language" 	=> "English"		, "level" 	=> "Intermediate"],
			["language" 	=> "Japanese"		, "level" 	=> "Around N3 and N2"],
		];
		$author->donate_url 		= "https://www.paypal.me/rakujin";

		return $author;
	}

}
