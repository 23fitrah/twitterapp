<?php namespace App\Http\Controllers;

//use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Request;
use Input;
use View;
use Twitter;

class TwitterController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function post_tweet()
	{
	      $tweet = Request::Input('tweet');

	      $respond=Twitter::postTweet(['status' => $tweet, 'format' => 'json']);

	      if($respond)
	      {
	      	$data['message']='success';
	      }else
	      {
	      	$data['message']='failed';
	      }

	    echo json_encode($data,JSON_PRETTY_PRINT);
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function tweet_list()
	{
		
		$tweet=Twitter::getUserTimeline(['count' => 20, 'format' => 'array']);
		$data=Array();

		$i=0;
		foreach ($tweet as $value) {
			$data[$i]['no']=$i+1;
			$data[$i]['id_tweet']=(String)$value['id'];
			$data[$i]['tweet']=trim($value['text']);
			$data[$i]['favorite']=$value['favorite_count'];
			$data[$i]['retweet']=$value['retweet_count'];
			$i++;
		}
 
		$datax['data'] = $data;
		$datax['countdata'] = COUNT($datax['data']);
		if($datax['countdata']){
			$datax['recordsTotal'] = count($datax['countdata']);
			$datax['recordsFiltered'] = count($datax['countdata']);

	 	}
 	 
		echo json_encode($datax,JSON_PRETTY_PRINT);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function tweet_detail($idx)
	{
		 
		$tweet=Twitter::getTweet($idx,['format' => 'array']);
		$data=Array();

		$data['id']=$tweet['id'];
		$data['text']=$tweet['text'];
		$data['create_at']=date('Y-m-d H:i:s',strtotime($tweet['created_at']));
		$data['favorite']=$tweet['favorite_count'];
		$data['retweet']=$tweet['retweet_count'];
		$data['place']=$tweet['place'];

		echo json_encode($data,JSON_PRETTY_PRINT);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function favorite_list()
	{
		$tweet=Twitter::getFavorites(['count' => 20, 'format' => 'array']);
		$data=Array();

		$i=0;
		foreach ($tweet as $value) {
			$data[$i]['favorite_count']=$value['favorite_count'];
			$data[$i]['id_tweet']=(String)$value['id'];
			$data[$i]['tweet']=trim($value['text']);
			$data[$i]['user_name']=$value['user']['name'];
			$data[$i]['screen_name']=$value['user']['screen_name'];
			$i++;
		}
 
		echo json_encode($data,JSON_PRETTY_PRINT);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function retweet_list()
	{
		
		$tweet=Twitter::getRtsTimeline(['count'=>10,'format'=>'array']);
		$data=Array();

		$i=0;
		foreach ($tweet as $value) {
			$data[$i]['retweet_count']=$value['retweet_count'];
			$data[$i]['id_tweet']=(String)$value['id'];
			$data[$i]['tweet']=trim($value['text']);
			$data[$i]['user_name']=$value['user']['name'];
			$data[$i]['screen_name']=$value['user']['screen_name'];
			$i++;
		}
 		 
		echo json_encode($data,JSON_PRETTY_PRINT);
	}

}
