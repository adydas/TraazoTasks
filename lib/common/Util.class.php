<?php

class Util{
	
	
	public static function userPrefOpenProjects($aid, $uid, $pid){

		
		
		$userPref = Doctrine::getTable("UserPref")->find(array($aid, $uid));
		if ($userPref){
			$prefs = unserialize($userPref->prefs);
			$openProjects = $prefs['open_projects'];
			
			if ($pid){
				$openProjects[] = $pid;
				$openProjects = array_unique($openProjects);
				$prefs = serialize(array('open_projects'=>$openProjects, 'projects_tabs_seq'=>$prefs['projects_tabs_seq']));
				
				$userPref->prefs = $prefs;
				$userPref->save();
			}
				
		}else{
			$userPref = new UserPref();
			$userPref->account_id = $aid;
			$userPref->user_id = $uid;
				
			$prefs = array();
			$openProjects = array($pid);
			$prefs = serialize(array('open_projects'=>$openProjects, 'projects_tabs_seq'=>$prefs['projects_tabs_seq']));
			
			if ($pid){
				$userPref->prefs = $prefs;
				$userPref->save();
			}
		}
		
		return $openProjects;
	}
	
	public static function userPrefOpenProjectTabSequence($aid, $uid, $pids){
		
		
		
		$userPref = Doctrine::getTable("UserPref")->find(array($aid, $uid));
		if ($userPref){
			$prefs = unserialize($userPref->prefs);
			$prefs['projects_tabs_seq'] = array_unique($pids);
			$prefs['open_projects'] = array_unique($pids);
			$prefs = serialize(array('open_projects'=>$prefs['open_projects'], 'projects_tabs_seq'=>$prefs['projects_tabs_seq']));
			if ($pids){
				$userPref->prefs = $prefs;
				$userPref->save();
			}
		}else{
			$userPref = new UserPref();
			$userPref->account_id = $aid;
			$userPref->user_id = $uid;
				
			$prefs = array();
			$prefs['projects_tabs_seq'] = array_unique($pids);
			$prefs['open_projects'] = array_unique($pids);
			$prefs = serialize(array('open_projects'=>$prefs['open_projects'], 'projects_tabs_seq'=>$prefs['projects_tabs_seq']));
			$userPref->prefs = $prefs;
			$userPref->save();
		}
		
		return $pids;
	}
	
	public static function doSearch($query, $mode='hits'){
		
		$replaceSub = array('er', 'ing');
		$replaceTarget = array('?', '?');
		
		$query = str_replace($replaceSub, $replaceTarget, $query);
		
		Zend_Search_Lucene_Analysis_Analyzer::setDefault( new StandardAnalyzer_Analyzer_Standard_English() );
        $index = new Zend_Search_Lucene(sfConfig::get('sf_data_dir').'/lucene/SPLASH.'.sfConfig::get('sf_environment').'.index');
        $hits = $index->find(strtolower($query));
		
        return $hits;
    }
	

	public static function getFiles($directory,$exempt = array('.','..','.ds_store','.svn'),&$files = array()) {
        
		if (!@is_dir($directory)) {
			return null;
		}
		
		$handle = opendir($directory);
        while(false !== ($resource = readdir($handle))) {
            if(!in_array(strtolower($resource),$exempt)) {
                if(is_dir($directory.$resource.'/'))
                    array_merge($files,
                        self::getFiles($directory.$resource.'/',$exempt,$files));
                else
                    $files[] = $directory.$resource;
            }
        }
        closedir($handle);
        return $files;
    } 

	public static function generatePassword ($length = 8)
	{

		// start with a blank password
		$password = "";

		// define possible characters
		$possible = "0123456789bcdfghjkmnpqrstvwxyz";

		// set up a counter
		$i = 0;

		// add random characters to $password until $length is reached
		while ($i < $length) {

			// pick a random character from the possible ones
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);

			// we don't want this character if it's already in the password
			if (!strstr($password, $char)) {
				$password .= $char;
				$i++;
			}

		}

		// done!
		return $password;
	}


	public static function log ( $message )
	{
		if ( is_null( $message ) )
		$message = 'NULL';

		fwrite( fopen( 'php://stderr', 'w' ), '[PHP] ' . $message . "\n" );
	}

	public static function guessRootDir()
	{
		$r = new ReflectionClass('ProjectConfiguration');
		return realpath(dirname($r->getFileName()).'/..');
	}

	public static function getClassConstant($class,$const){
		return constant(sprintf('%s::%s', $class, $const));
	}

	//recursively creates a folder.
	public static function mk_dir($path, $rights = 0777) {//{{{
		//$folder_path = array(strstr($path, '.') ? dirname($path) : $path);
		if (!@is_dir($path)) {
			$folder_path = array($path);
		} else {
			return;
		}

		while(!@is_dir(dirname(end($folder_path)))
		&& dirname(end($folder_path)) != '/'
		&& dirname(end($folder_path)) != '.'
		&& dirname(end($folder_path)) != '')
		{
			array_push($folder_path, dirname(end($folder_path)));
		}

		while($parent_folder_path = array_pop($folder_path)) {
			if(!@mkdir($parent_folder_path, $rights)) {
				user_error("Can't create folder \"$parent_folder_path\".\n");
			}
		}
	}//}}}

	public static function tab_link($name_value_list,$parameter,$parameter_list, $page, $active=''){

		$str = '<div id="tab-group">'.
        '<ul id="nav-tab">';

		foreach($name_value_list as $option_name => $option_value){
			$str .= '<li ';
			if($option_value == $active)
			$str .= ' class="active" ';
			$str .= '>';

			$parameter_list->set($parameter,$option_value);
			$link = array();

			foreach($parameter_list->getAll() as $name => $value){
				if(strlen(trim($name)))
				$link []= $name.'='.$value;
			}

			if($option_value == $active
			|| $option_value == '')
			$str .= $option_name;
			else
			$str .= link_to($option_name,$page.'?'.implode('&',$link));

			$str.='</li>';
		}

		$str .= '</ul></div>';

		return $str;

	}

	/*
	 * A selector that generates AJAX requests.
	 *
	 * @param a hash of name-value pairs
	 *
	 * @param the name of the parameter that this selector governs
	 *
	 * @param the parameter_holder object, taken from the action class, e.g. Leaderboards/actions/action.class.php
	 *
	 * @param the target page that the AJAX request talks to
	 *
	 * @param the currently selected value
	 *
	 * @param a hash of options to generate the AJAX request
	 *
	 */

	public static function tab_link_remote($name_value_list,$parameter,$parameter_list, $page, $active='',$remote_options, $style_options ){

		if(isset($style_options['ul_id'])){
			$str = '<ul class="'.$style_options['ul_id'].'">';
		}else
		$str = '<ul >';

		foreach($name_value_list as $option_name => $properties){

			$option_value = $properties['value'];
			$option_id = $properties['id'];

			$parameter_list->set($parameter,$option_value);
			$link = array();

			foreach($parameter_list->getAll() as $name => $value){
				if(!in_array($name, array('module','action')))
				if(strlen(trim($name)))
				$link []= $name.'='.$value;
			}

			$option_name = content_tag('span',$option_name);


			if($option_value === $active)
			$content = content_tag('a',$option_name,array('class'=>'current'));
			else if($option_value === NULL)
			$content = content_tag('a',$option_name,array('class'=>'disabled'));
			else{
				$uri = $page.'?'.implode('&',$link);

				$remote_options['url'] = $uri;

				$content = link_to_remote($option_name,
				$remote_options,
				$style_options);
			}

			$style = array();
			if($option_id)
			$style['id'] = $option_id;

			$str .= content_tag('li',$content,$style);

		}

		$str .= '</ul>';

		return $str;

	}

	/* takes the parameter holder object, filters out a couple of items that shouldn't be passed to the remote scripts.
	 the $parameter will also be filtered out, since this value gets added by the Ajax.Updater() call
	 */

	public static function compile_uri($parameter_holder,$request_page,$parameter){

		/* compile the parameter holder into a URI for the AJAX call to the remote script */
		foreach($parameter_holder->getAll() as $name => $value){
			if(!in_array($name, array('module','action',$parameter)))
			if(strlen(trim($name)))
			$link []= $name.'='.$value;
		}
		$uri = $request_page.'?'.implode('&',$link);

		return $uri;
	}


	//the width of the biggest char @
	//  $fontwidth = 11;

	//each chargroup has char-ords that have the same proportional displaying width
	public static $chargroup = array(
	0=>array(64),
	1=>array(37,87,119),
	2=>array(65,71,77,79,81,86,89,109),
	3=>array(38,66,67,68,72,75,78,82,83,85,88,90),
	4=>array(35,36,43,48,49,50,51,52,53,54,55,56,57,60,61,62,63, 69,70,76,80,84,95,97,98,99,100,101,103,104,110,111,112, 113,115,117,118,120,121,122,126),
	5=>array(74,94,107),
	6=>array(34,40,41,42,45,96,102,114,123,125),
	7=>array(44,46,47,58,59,91,92,93,116),
	8=>array(33,39,73,105,106,108,124)
	);

	//how the displaying width are compared to the biggest char width
	public static $chargroup_relwidth = array(
	0=> 1, //is char @
	1=> 0.909413854,
	2=> 0.728241563,
	3=> 0.637655417,
	4=> 0.547069272,
	5=> 0.456483126,
	6=> 0.36589698,
	7=> 0.275310835,
	8=> 0.184724689
	);

	public static $char_relwidth = NULL;


	// building the reference array, should only happen once per page.
	private static function build_char_relwidth(){
		if(self::$char_relwidth == null){
			self::$char_relwidth = array();

			for ($i=0;$i<count(self::$chargroup);$i++){
				for ($j=0;$j<count(self::$chargroup[$i]);$j++){
					self::$char_relwidth[self::$chargroup[$i][$j]] = self::$chargroup_relwidth[$i];
				}
			}
		}
	}

	//characters out of the mapped ranges above get '0' as value.
	private static function get_rel_width($str){

		$ascii_val = ord($str);

		if(!isset(self::$char_relwidth[$ascii_val]))
		return 0;
		else
		return self::$char_relwidth[$ascii_val];

	}

	//get the display width (in pixels) of a string
	private static function get_str_width($str,$fontwidth=11){
		self::build_char_relwidth();

		$result = 0;
		for ($i=0;$i<strlen($str);$i++){
			$result += self::get_rel_width($str[$i]);
		}
		$result = $result * $fontwidth;
		return $result;
	}

	/* truncates a string at a certain displaying pixel width
	 * @param the source string
	 * @param the width in pixels of the limit
	 * @param the string used for truncation
	 * @param the width of the font, e.g. Arial 11
	 */

	public static function truncate_str_at_width($str, $width, $trunstr='...',$fontwidth=11){

		$trunstr_width = self::get_str_width($trunstr);

		$width -= $trunstr_width;
		$width = $width/$fontwidth;
		$w = 0;
		for ($i=0;$i<strlen($str);$i++){
			//      $w += self::$char_relwidth[ord($str[$i])];
			$w += self::get_rel_width($str[$i]);
			if ($w > $width)
			break;
		}
		if(strlen($str) > $i)
		$result = substr($str,0,$i).$trunstr;
		else
		$result = $str;
		return $result;
		// texas is the reason rules at 10am :)
	}
	public static $state = array(
            'AL'=>"Alabama",
            'AK'=>"Alaska",  
            'AZ'=>"Arizona",  
            'AR'=>"Arkansas",  
            'CA'=>"California",  
            'CO'=>"Colorado",  
            'CT'=>"Connecticut",  
            'DE'=>"Delaware",  
            'DC'=>"District Of Columbia",  
            'FL'=>"Florida",  
            'GA'=>"Georgia",  
            'HI'=>"Hawaii",  
            'ID'=>"Idaho",  
            'IL'=>"Illinois",  
            'IN'=>"Indiana",  
            'IA'=>"Iowa",  
            'KS'=>"Kansas",  
            'KY'=>"Kentucky",  
            'LA'=>"Louisiana",  
            'ME'=>"Maine",  
            'MD'=>"Maryland",  
            'MA'=>"Massachusetts",  
            'MI'=>"Michigan",  
            'MN'=>"Minnesota",  
            'MS'=>"Mississippi",  
            'MO'=>"Missouri",  
            'MT'=>"Montana",
            'NE'=>"Nebraska",
            'NV'=>"Nevada",
            'NH'=>"New Hampshire",
            'NJ'=>"New Jersey",
            'NM'=>"New Mexico",
            'NY'=>"New York",
            'NC'=>"North Carolina",
            'ND'=>"North Dakota",
            'OH'=>"Ohio",  
            'OK'=>"Oklahoma",  
            'OR'=>"Oregon",  
            'PA'=>"Pennsylvania",  
            'RI'=>"Rhode Island",  
            'SC'=>"South Carolina",  
            'SD'=>"South Dakota",
            'TN'=>"Tennessee",  
            'TX'=>"Texas",  
            'UT'=>"Utah",  
            'VT'=>"Vermont",  
            'VA'=>"Virginia",  
            'WA'=>"Washington",  
            'WV'=>"West Virginia",  
            'WI'=>"Wisconsin",  
            'WY'=>"Wyoming");



}
?>