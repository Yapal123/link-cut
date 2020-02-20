<?php 
namespace core;

use core\Db;

class Links{
	/**
	 * Method that generating shot link
	 * @param string $link - full user link
	 */
	public function generate_link($link)
	{
		 $seed = str_split('abcdefghijklmnopqrstuvwxyz'
	                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
	                 .'0123456789'); 
		shuffle($seed); 
		$rand = '';
		foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
		$params = [
			'link_slug' => $rand,
			'redirect_link' => $link
		];
		return ['params'=>$params,'user_link' => $rand];
	}
	/**
	 * Method which add link to database
	 * @param Array $params - arguments with link ifno, which need send to sql 
	 */
	public function add_link($params)
	{
		$db = new Db;
		$db->insert('links_list','link_slug, redirect_link',':link_slug, :redirect_link',$params);

	}
	/**
	 * Method for redirecting user from our service link to user link
	 * @param string $link - link slug from our service
	 */
	public function link_redirecting($link)
	{
		$db = new Db;
		$params = ['link_slug' => $link];
		$abs_link = $db->query("SELECT redirect_link FROM links_list WHERE link_slug = :link_slug",$params)[0]['redirect_link'];
		header("Location: http://$abs_link",true,301);
		die();
	}
	/**
	 * Method which get all links
	 */
	public function links_list()
	{
		$db = new Db;
		return $db->query("SELECT * FROM `links_list`");
	}
	/**
	 * Method which remove link by $id
	 * @param int $id - id of link
	 */
	public function remove_link($id)
	{
		$db = new Db;
		$params = ['id' => $id];
		$db->query("DELETE FROM links_list WHERE id = :id",$params);
	}
}