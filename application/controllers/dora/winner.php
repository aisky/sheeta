<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 处理 365winner 的控制器
 */
class Winner extends CI_Controller {

	var $site = 'http://www.365winner.biz/';

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//抓取这个页面
		//http://www.365winner.biz/allArticle.aspx
		//分页：http://www.365winner.biz/allArticle.aspx?p=2
		$url = 'http://www.365winner.biz/allArticle.aspx';

		//第一次採时，尽量採多些页面
		//todo
		/*for($i=1;$i<10;$i++)
		{

		}*/

		foreach( $this->_list($url) as $v )
		{
			$this->_content( $this->site . 'Article.aspx?id=' . $v );

			echo '<hr>';
			die;
		}

	}

	//command preg_match
	function _preg_match($preg, $content, $is_arr=true)
	{
		preg_match_all($preg, $content, $match);
		if($is_arr)
		{
			return isset($match[1]) ? $match[1] : array();
		}
		else
		{
			return isset($match[1][0]) ? $match[1][0] : '';
		}
	}

	//get list
	function _list($url)
	{
		$content = file_get_contents($url);
		//保留article 识别度高些
		return $this->_preg_match('/<a href="Article\.aspx\?id=(.+)" title=".+" target="_blank">/', $content);
	}

	//get content
	function _content($url)
	{
		$content = file_get_contents($url);

		//day
		$day = $this->_preg_match('%<em>发布时间：</em><span>(.+)</span>%', $content, false);

		//news_content
//		echo $new_content = $this->_preg_match('%<div id="post_con">(*)</div>%', $content, false);
		preg_match_all('%<div id="post_con">*</div>%', $content, $match);

		print_r($match);
	}
}
