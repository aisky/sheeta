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

	public function index( $id='' )
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

        if( $id > 0 )
        {
            $arr = $this->_content( $this->site . 'Article.aspx?id=' . $id );
            $this->_save($arr);
        }
        else
        {
            foreach( $this->_list($url) as $v )
            {
                $arr = $this->_content( $this->site . 'Article.aspx?id=' . $v );

                $this->_save($arr);

                echo '<hr>';
               // die;
            }
        }
	}

	//command preg_match
	function _preg_match($preg, $content, $is_arr=false)
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
        //限制在列表div内
        $content = $this->_preg_match('/<div class="gambling_tips_list">(.*?)<\/div>/is', $content);
		//保留article 识别度高些
		return $this->_preg_match('/<a href="Article\.aspx\?id=(.+)" title=".+" target="_blank">/', $content, true);
	}

	//get content
	function _content($url)
	{
        $return = array();
        $return['url'] = $url;

        $content = file_get_contents($url);
		//day
		$return['day'] = $this->_preg_match('%<em>发布时间：</em><span>(.+)</span>%', $content);

		//news_content
		$return['content'] = $this->_filter( $this->_preg_match('/<div id="post_con">(.*?)(<!-- Baidu Button BEGIN -->|<p>相关阅读)/is', $content) );

        //tagname
        $tag_div = $this->_preg_match('/<div class="crumb">(.*?)<\/div>/is', $content);
        $tag_a = $this->_preg_match('/<a.+?>(.*?)<\/a>/is', $tag_div, true);
        $return['tagname'] = isset($tag_a[1]) ? $tag_a[1] : '';

        return $return;
	}

    //过滤
    function _filter($content)
    {
        $filter = array(
            '%<p style="text-align:center;"><img src=".+? /></p>%s' => '',
            '%<a .+?>.+?</a>%s' => ''
        );

        foreach($filter as $k=>$v)
        {
            $content = preg_replace($k, $v, $content);
        }

        return $content;
    }

    //保存
    function _save($news_arr)
    {
        print_r($news_arr);
    }
}
