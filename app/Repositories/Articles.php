<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Repositories\GetKeywords;

/**
* 
*/
class Articles
{
	protected $client;
	
	function __construct($client)
	{
		$this->client = $client;
	}


	public function init()
	{	
    	$querySearched = "";

		if (Auth::user()->groupe->id === 1)
    			$querySearched = '"*:* ';
  
    	else
			$querySearched = (new GetKeywords(Auth::user()))->get();
		/*
		}*/
			
		$thequery = "";
		$Textfields = ['Title', 'Fulltext'];

		foreach ($Textfields as $value) {
		  $thequery .= $value.":(".$querySearched.") ";
		}

		// get a select query instance
		$query = $this->client->createSelect();

		$query->setFields(['id','Title', 'Fulltext','document', 'Source', 'SourceDate','Author', 'ArticleLanguage']);

		$query->setStart(0)->setRows(17);

		// get the dismax component and set a boost query
		$edismax = $query->getEDisMax();
		$query->createFilterQuery('filterkeywords')->setQuery($thequery);


		// get the facetset component
		$facetSet = $query->getFacetSet();
		$facetSet->createFacetField('language')->setField('ArticleLanguage');
		$facetSet->createFacetField('author')->setField('Author');
		$facetSet->createFacetField('source')->setField('Source');
		$facetSet->setMinCount(1);

		// Get highlighting component, and apply settings
		$hl = $query->getHighlighting();
		$hl->setSnippets(5);
		$hl->setFields(array('Title', 'Fulltext'));

		$hl->setSimplePrefix('<strong class="mdl-color-text--primary">');
		$hl->setSimplePostfix('</strong>');

		return $query;

	}

	/**
	 * @return array $resultset
	*/
	public function index()
	{
		$query = Articles::init();

		// this executes the query and returns the result
		return $resultset = $this->client->select($query);
	}

	/**
	 * @return array $resultset
	*/
	public function sort($data) {
		$query = Articles::init();
		$helper = $query->getHelper();

		if ($data === "récents")
			$query->addSort('SourceDate', $query::SORT_DESC);
		elseif ($data === "anciens")
			$query->addSort('SourceDate', $query::SORT_ASC);
		elseif ($data === "pertinents")
			$query->addSort('score', $query::SORT_DESC);
		elseif (substr($data, 0, 6) === 'langue') {
			$query->createFilterQuery('language')->setQuery('ArticleLanguage:"'.$helper->escapePhrase(substr($data, 7)).'"');
		}
		elseif (substr($data, 0, 4) === 'date') {
			$date = substr($data, 5);
			$query->createFilterQuery('date')->setQuery('SourceDate:'.$helper->escapePhrase($date));
		}
		else
			$query->createFilterQuery(substr($data, 0, 6))->setQuery(ucfirst(substr($data, 0, 6)).':'.$helper->escapePhrase(substr($data, 7)));
		

		// this executes the query and returns the result
		return $resultset = $this->client->select($query);
	}

	/**
	 * 
	 * @return array $resultset
	*/
	public function search($request)
	{
		$query = Articles::init();
		$helper = $query->getHelper();

		$thequery = "";

		$Textfields = ['Title', 'Fulltext'];

		foreach ($Textfields as $value) {
		  $thequery .= $value.":(".$request.") ";
		}
		$query->setQuery($thequery);

		//new code
		if ($request === 'language') {
			$thequery1 = 'ArticleLanguage:"'.$request->language.'"';
			$query->createFilterQuery('language')->setQuery($thequery1);

		}

		// this executes the query and returns the result
		return $resultset = $this->client->select($query);
	}

	public function show($request)
	{
		$query = Articles::init();
		$helper = $query->getHelper();

		$thequery = 'id:"'.$request.'"';
		$query->setQuery($thequery);

		// this executes the query and returns the result
		return $resultset = $this->client->select($query);	
	}

}