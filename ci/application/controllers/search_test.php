<?php
class Search_test extends CI_Controller{
	public function __construct(){
        parent::__construct();
        $this->load->model('search_model');
	}
/* TESTLISTOR (skapade av user: admin)
titel 						tags 			Kategori
test_simple_search			testtag			Teknik
test_double_search			test tag 		Teknik
test_advanced_search		"test tag"		Teknik
test_complex_search			test "test tag"	Teknik
test_swedish_search 		åäö				Teknik
test_complex_swedish_search	"å ä ö"			Teknik
test_category_search		(inget)			Familj
*/
	function index(){
		$this->test_simple_search();
		$this->test_double_search();
		$this->test_advanced_search();
		$this->test_complex_search();
		$this->test_swedish_search();
		$this->test_complex_swedish_search();
		$this->test_category_search();
		echo $this->unit->report();
	}

	/*
	 * Testar enkel sökning
	 * INPUT: testtag
	 * en enda tag
	 * OUTPUT: lista med titel == x
	 * eventuellt flera listor som output
	 */	
	function test_simple_search(){
		$tags='testtag';		
		$row = $this->search_model->search('testtag');
		if($row[0]){
			$result =$row[0]->title;
		}
		else{
			$result=$row;
		}
		$expected_result = 'test_simple_search';
		$this->unit->run($result, $expected_result, 'test_simple_search');
	}

/*
	 * Testar dubbel sökning
	 * INPUT: test tag 
	 * TVÅ taggar
	 * OUTPUT: två listor, en matchad tag per lista
	 */	
	function test_double_search(){
		$tags='test tag';
		$row = $this->search_model->search($tags);
		if($row[0]){
			$result2 = $row[0]->title; //test_double_search - två taggar
			$result1 = $row[1]->title; //test_complex_search - en tagg
		}
		else{
			$result=$row;
		}
		$expected_result1 = 'test_double_search';
		$expected_result2 = 'test_complex_search';
		$this->unit->run($result1, $expected_result1, 'test_double_search - en tagg');
		$this->unit->run($result2, $expected_result2, 'test_double_search - två taggar');

	}

	/*
	 * Testar avancerad sökning
	 * INPUT: "test tag"
	 * lång tag innehållandes space 
	 * OUTPUT: en lista
	 */
	function test_advanced_search(){
		$tags='"test tag"';

		$row = $this->search_model->search($tags);
		if($row[0]){
			$result =$row[1]->title;
		}
		else{
			$result=$row;
		}
		$expected_result = 'test_advanced_search';
		$this->unit->run($result, $expected_result, 'test_advanced_search');
	}

/*
	 * Testar komplex sökning
	 * INPUT: test "test tag" 
	 * en enkel tag och en lång tag innehållandes space, ex: "test tag"
	 * OUTPUT: en lista
	 */
	function test_complex_search(){
		$tags='test "testtag"';

		$row = $this->search_model->search($tags);
		if($row[0]){
			$result =$row[0]->title;
		}
		else{
			$result=$row;
		}
		$expected_result = 'test_complex_search';
		$this->unit->run($result, $expected_result, 'test_complex_search');
	}

/*
	 * Testar enkel åäö sökning
	 * INPUT: åäö 
	 * en enkel tag med svenska tecken
	 * OUTPUT: en lista
	 */
	function test_swedish_search(){
		$tags='åäö';
		
		$row = $this->search_model->search('åäö');
		if($row[0]){
			$result =$row[0]->title;
		}
		else{
			$result=$row;
		}
		$expected_result = 'test_swedish_search';
		$this->unit->run($result, $expected_result, 'test_swedish_search');
	}

/*
	 * Testar komplex åäö sökning
	 * INPUT: "å ä ö" 
	 * en avancerad tag med svenska tecken
	 * OUTPUT: en lista
	 */
	function test_complex_swedish_search(){
		$tags='"å ä ö"';
		$row = $this->search_model->search('"å ä ö"');
		if($row[0]){
			$result =$row[0]->title;
		}
		else{
			$result=$row;
		}
		$expected_result = 'test_complex_swedish_search';
		$this->unit->run($result, $expected_result, 'test_complex_swedish_search');
	}

/*
	 * Testar kategori sökning
	 * INPUT: "" och kategori: 
	 * en avancerad tag med svenska tecken
	 * OUTPUT: en lista
	 */
	function test_category_search(){
		$tags='';
		$category = 'Teknik';
		$row = $this->search_model->search($tags, $category);
		$result = TRUE;
		foreach ($row as $r) {
			if($r->category!==$category){
				$result=FALSE;
			}
		}
		$expected_result=TRUE;
		$this->unit->run($result, $expected_result, 'test_category_search');
	}

	/*
	 * Testar kategori och complex sökning
	 * INPUT
	 */
	function test_complex_category_search(){
		$tags='weird';
		$category = 'Bild';
		$row = $this->search_model->search($tags, $category);
		$result = TRUE;
		foreach ($row as $r) {
			if($r->category!==$category && $r->title !=='weird test'){
				$result=FALSE;
			}
		}
		$expected_result=TRUE;
		$this->unit->run($result, $expected_result, 'test_complex_category_search');
	}
}