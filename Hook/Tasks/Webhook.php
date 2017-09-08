<?php
namespace App\HookPipe\Hook\Tasks;

use GuzzleHttp\Client;

/**
 * @todo there should be a settings function
 * or different properties for the class which 
 * defines smoking settings
 */
class Webhook extends BasicTask
{
	public $_models = ['Webhooks'];

	public $url = '';

	private $wh;

	/**
	 * { function_description }
	 *
	 * @param      string  $url    The url
	 */
	public function __construct($url='')
	{
		parent::__construct();
		$this->url = $url;
	}

	/**
	 * { function_description }
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function get()
	{
		return $this->wh;
	}

	public function set($webhookId='')
	{
		$this->wh =	$this->Webhooks->get($webhookId);

		return true;
	}

	/**
	 * { function_description }
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function save()
	{
		$webhook = $this->Webhooks->newEntity();
		$data['url'] = $this->url;
		$data['enabled'] = FALSE;
		$this->Webhooks->patchEntity($webhook, $data);

		if($this->Webhooks->save($webhook)) {
			$this->wh = $webhook;
			return true;
		}
		return false;
	}


	
	/**
	 * { function_description }
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function enable()
	{
		$webhook = $this->Webhooks->get($this->wh->id);
		$webhook->enabled = TRUE;
		if($this->Webhooks->save($webhook)) {
			$this->wh = $webhook;
			return true;
		}
		return false;
	}


	/**
	 * { function_description }
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function disable()
	{
		$webhook = $this->Webhooks->get($this->wh->id);
		$webhook->enabled = FALSE;
		if($this->Webhooks->save($webhook)) {
			$this->wh = $webhook;
			return true;
		}
		return false;
	}

	/**
	 * { function_description }
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 * @todo code your own exception class
	 */
	public function smoke()
	{
		if (!$this->wh->enabled) {
			return false;
		}

		$client = new Client();

		try {
			$res = $client->request('GET', $this->wh->url);	
		} catch (GuzzleHttp\Exception\RequestException $e) {
			return $e;
		}

		dump($this->wh->url);

		return $res->getStatusCode();		
	}
}