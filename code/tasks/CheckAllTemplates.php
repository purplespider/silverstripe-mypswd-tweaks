<?php

/**
 * @description (see $this->description)
 *
 * @authors: Andrew Pett [at] sunny side up .co.nz, Nicolaas [at] Sunny Side Up .co.nz
 * @package: templateoverview
 * @sub-package: tasks
 **/

class CheckAllTemplates extends BuildTask
{

    protected $title = 'Check URLs for HTTP errors';

    protected $description = "Will go through main URLs (all page types (e.g Page, MyPageTemplate), all page types in CMS (e.g. edit Page, edit HomePage, new MyPage) and all models being edited in ModelAdmin, checking for HTTP response errors (e.g. 404). Click start to run.";

    /**
      * List of URLs to be checked. Excludes front end pages (Cart pages etc).
      */
    private $modelAdmins = array();

    /**
     * @var Array
     * all of the public acessible links
     */
    private $allOpenLinks = array();

    /**
     * @var Array
     * all of the admin acessible links
     */
    private $allAdmins = array();

    /**
     * @var Array
     * all of the admin acessible links
     */
    private $customLinks = array();

    /**
     * @var Array
     * Pages to check by class name. For example, for "ClassPage", will check the first instance of the cart page.
     */
    private $classNames = array();

    /**
     *
     * @var curlHolder
     */
    private $ch = null;

    /**
     * temporary Admin used to log in.
     * @var Member
     */
    private $member = null;

    /**
     * temporary username for temporary admin
     * @var String
     */
    private $username = "";

    /**
     * temporary password for temporary admin
     * @var String
     */
    private $password = "";

    /**
     * @var Boolean
     */
    private $w3validation = true;

    /**
     * Main function
     * has two streams:
     * 1. check on url specified in GET variable.
     * 2. create a list of urls to check
     *
     */
    public function run($request)
    {
        $asAdmin = empty($_REQUEST["admin"]) ? false : true;
        $testOne = isset($_REQUEST["test"]) ? $_GET["test"] : null;

        //1. actually test a URL and return the data
        if ($testOne) {
            $this->setupCurl();
            if ($asAdmin) {
                $this->createAndLoginUser();
            }
            echo $this->testURL($testOne, $this->w3validation);
            $this->cleanup();
        }

        //2. create a list of
        else {
            Requirements::javascript(THIRDPARTY_DIR . '//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js');
            $this->classNames = $this->listOfAllClasses();
            $this->modelAdmins = $this->ListOfAllModelAdmins();
            $this->allNonAdmins = $this->prepareClasses();
            $otherLinks = $this->listOfAllControllerMethods();
            $this->allAdmins = $this->array_push_array($this->modelAdmins, $this->prepareClasses(1));
            $this->allAdmins = $this->array_push_array($this->allAdmins, $this->customLinks);
            $sections = array("allNonAdmins", "allAdmins");
            $count = 0;
            echo "<h1><a href=\"#\" class=\"start\">start</a> | <a href=\"#\" class=\"stop\">stop</a></h1>
			<table border='1'>
			<tr><th>Link</th><th>HTTP response</th><th>response TIME</th><th class'error'>error</th><th class'error'>W3 Check</th></tr>";
            foreach ($sections as $isAdmin => $section) {
                foreach ($this->$section as $link) {
                    $count++;
                    $id = "ID".$count;
                    $linkArray[] = array("IsAdmin" => $isAdmin, "Link" => $link, "ID" => $id);
                    echo "
						<tr id=\"$id\" class=".($isAdmin ? "isAdmin" : "notAdmin").">
							<td><a href=\"".Director::baseURL()."dev/tasks/CheckAllTemplates/?test=".urlencode($link)."&admin=".$isAdmin."\" style='color: purple' target='_blank'>$link</a></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					";
                }
            }
            echo "
			</table>
			<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js' ></script>
			<script type='text/javascript'>

				jQuery(document).ready(
					function(){
						checker.init();
					}
				);

				var checker = {
					list: ".Convert::raw2json($linkArray).",

					baseURL: '/dev/tasks/CheckAllTemplates/',

					item: null,

					stop: true,

					init: function() {
						jQuery('a.start').click(
							function() {
								checker.stop = false;
								if(!checker.item) {
									checker.item = checker.list.shift();
								}
								checker.checkURL();
							}
						);
						jQuery('a.stop').click(
							function() {
								checker.stop = true;
							}
						);
					},

					checkURL: function(){
						if(checker.stop) {

						}
						else {
							var testLink = (checker.item.Link);
							var isAdmin = checker.item.IsAdmin;
							var ID = checker.item.ID;
							jQuery('#'+ID).find('td')
								.css('border', '1px solid blue');
							jQuery('#'+ID).css('background-image', 'url(/cms/images/loading.gif)')
								.css('background-repeat', 'no-repeat')
								.css('background-position', 'top right');
							jQuery.ajax({
								url: checker.baseURL,
								type: 'get',
								data: {'test': testLink, 'admin': isAdmin},
								success: function(data, textStatus){
									checker.item = null;
									jQuery('#'+ID).html(data).css('background-image', 'none');
									jQuery('#'+ID).find('h1').remove();
									checker.item = checker.list.shift();
									jQuery('#'+ID).find('td').css('border', '1px solid green');

									window.setTimeout(
										function() {checker.checkURL();},
										1000
									);
								},
								error: function(){
									checker.item = null;
									jQuery('#'+ID).find('td.error').html('ERROR');
									jQuery('#'+ID).css('background-image', 'none');
									checker.item = checker.list.shift();
									jQuery('#'+ID).find('td').css('border', '1px solid red');
									window.setTimeout(
										function() {checker.checkURL();},
										1000
									);
								},
								dataType: 'html'
							});
						}
					}
				}
			</script>";
            echo "<h2>Want to add more tests?</h2>
			<p>
				By adding a public method <i>templateoverviewtests</i> to any controller,
				returning an array of links, they will be included in the list above.
			</p>
			";
            echo "<h3>Suggestions</h3>
			<p>Below is a list of suggested controller links.</p>
			<ul>";
            foreach ($otherLinks as $link) {
                echo "<li><a href=\"$link\">$link</a></li>";
            }
            echo "</ul>";
        }
    }

    /**
     * creates the basic curl
     *
     */
    private function setupCurl($type = "GET")
    {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        $post = $type == "GET" ? false : true;
        $options = array(
            CURLOPT_CUSTOMREQUEST  =>$type,        //set request type post or get
            CURLOPT_POST           =>$post,        //set to GET
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        );

        $this->ch = curl_init();
        curl_setopt_array($this->ch, $options);
    }



    /**
     * creates and logs in a temporary user.
     *
     */
    private function createAndLoginUser()
    {
        $this->username = "TEMPLATEOVERVIEW_URLCHECKER___";
        $this->password = rand(1000000000, 9999999999);
        //Make temporary admin member
        $adminMember = Member::get()->filter(array("Email" => $this->username))->first();
        if ($adminMember != null) {
            $adminMember->delete();
        }
        $this->member = new Member();
        $this->member->Email = $this->username;
        $this->member->Password = $this->password;
        $this->member->write();
        $adminGroup = Group::get()->filter(array("code" => "administrators"))->first();
        if (!$adminGroup) {
            user_error("No admin group exists");
        }
        $this->member->Groups()->add($adminGroup);

        curl_setopt($this->ch, CURLOPT_USERPWD, $this->username.":".$this->password);

        $loginUrl = Director::absoluteURL('/Security/LoginForm');
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($this->ch, CURLOPT_URL, $loginUrl);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, 'Email='.$this->username.'&Password='.$this->password);


        //execute the request (the login)
        $loginContent = curl_exec($this->ch);
        $httpCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $err               = curl_errno($this->ch);
        $errmsg            = curl_error($this->ch);
        $header            = curl_getinfo($this->ch);
        if ($httpCode != 200) {
            echo "<span style='color:red'>There was an error logging in!</span><br />";
        }
    }

    /**
     * removes the temporary user
     * and cleans up the curl connection.
     *
     */
    private function cleanup()
    {
        if ($this->member) {
            $this->member->delete();
        }
        curl_close($this->ch);
    }

    /**
      * Takes an array, takes one item out, and returns new array
      * @param Array $array Array which will have an item taken out of it.
      * @param - $exclusion Item to be taken out of $array
      * @return Array New array.
      */
    private function arrayExcept($array, $exclusion)
    {
        $newArray = $array;
        for ($i = 0; $i < count($newArray); $i++) {
            if ($newArray[$i] == $exclusion) {
                unset($newArray[$i]);
            }
        }
        return $newArray;
    }

    /**
     * ECHOES the result of testing the URL....
     * @param String $url
     */
    private function testURL($url, $validate = true)
    {
        if (strlen(trim($url)) < 1) {
            user_error("empty url"); //Checks for empty strings.
        }
        if (strpos($url, "/admin") === 0 || strpos($url, "admin") === 0) {
            $validate = false;
        }

        $url = Director::absoluteURL($url);

        //start basic CURL
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $response          = curl_exec($this->ch);

        $httpCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        if ($httpCode == "401") {
            $this->createAndLoginUser();
            return $this->testURL($url, false);
        }
        //get more curl!

        $err               = curl_errno($this->ch);
        $errmsg            = curl_error($this->ch);
        $header            = curl_getinfo($this->ch);
        $length            = curl_getinfo($this->ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        $timeTaken         = curl_getinfo($this->ch, CURLINFO_TOTAL_TIME);
        $timeTaken = number_format((float)$timeTaken, 2, '.', '');
        $possibleError = false;
        if ((strlen($response) < 500) || ($length < 500) || (substr($response, 0, 11) == "Fatal error")) {
            $error = "<span style='color: red;'>short response / error response</span> ";
        }
        $error = "none";
        $html = "";
        if ($httpCode == 200) {
            $html .= "<td style='color:green'><a href='$url' style='color: grey!important; text-decoration: none;' target='_blank'>$url</a></td>";
        } else {
            $error = "unexpected response";
            $html .= "<td style='color:red'><a href='$url' style='color: red!important; text-decoration: none;'>$url</a></td>";
        }
        $html .= "<td style='text-align: right'>$httpCode</td><td style='text-align: right'>$timeTaken</td><td>$error</td>";

        if ($validate && $httpCode == 200) {
            $w3Obj = new CheckAllTemplates_W3cValidateApi();
            $html .= "<td>".$w3Obj->W3Validate("", $response)."</td>";
        } else {
            $html .= "<td>n/a</td>";
        }
        return $html;
    }

    /**
      * Pushes an array of items to an array
      * @param Array $array Array to push items to (will overwrite)
      * @param Array $pushArray Array of items to push to $array.
      */
    private function array_push_array($array, $pushArray)
    {
        foreach ($pushArray as $pushItem) {
            array_push($array, $pushItem);
        }
        return $array;
    }

    /**
     * returns a lis of all SiteTree Classes
     * @return Array(String)
     */
    private function listOfAllClasses()
    {
        $pages = array();
        $list = null;
        if (class_exists("TemplateOverviewPage")) {
            $templateOverviewPage = TemplateOverviewPage::get()->First();
            if (!$templateOverviewPage) {
                $templateOverviewPage = singleton("TemplateOverviewPage");
            }
            $list = $templateOverviewPage->ListOfAllClasses();
            foreach ($list as $page) {
                $pages[] = $page->ClassName;
            }
        }
        if (!count($pages)) {
            $list = ClassInfo::subclassesFor("SiteTree");
            foreach ($list as $page) {
                $pages[] = $page;
            }
        }
        return $pages;
    }

    /**
     * returns a list of all model admin links
     * @return Array(String)
     */
    private function ListOfAllModelAdmins()
    {
        $models = array();
        $modelAdmins = CMSMenu::get_cms_classes("ModelAdmin");
        if ($modelAdmins && count($modelAdmins)) {
            foreach ($modelAdmins as $modelAdmin) {
                if ($modelAdmin != "ModelAdminEcommerceBaseClass") {
                    $obj = singleton($modelAdmin);
                    $modelAdminLink = $obj->Link();
                    $models[] = $modelAdminLink;
                    $modelsToAdd = $obj->getManagedModels();
                    if ($modelsToAdd && count($modelsToAdd)) {
                        foreach ($modelsToAdd as $key => $model) {
                            if (is_array($model) || !is_subclass_of($model, "DataObject")) {
                                $model = $key;
                            }
                            if (!is_subclass_of($model, "DataObject")) {
                                continue;
                            }
                            $modelLink = $modelAdminLink.$model."/";
                            $models[] = $modelLink;
                            $models[] = $modelLink."EditForm/field/".$model."/item/new/";
                            if ($item = $model::get()->First()) {
                                $models[] = $modelLink."EditForm/field/".$model."/item/".$item->ID."/edit";
                            }
                        }
                    }
                }
            }
        }
        return $models;
    }

    protected function listOfAllControllerMethods()
    {
        $array = array();
        $classes = ClassInfo::subclassesFor("Controller");
        //foreach($manifest as $class => $compareFilePath) {
            //if(stripos($compareFilePath, $absFolderPath) === 0) $matchedClasses[] = $class;
        //}
        $manifest = SS_ClassLoader::instance()->getManifest()->getClasses();
        $baseFolder = Director::baseFolder();
        $cmsBaseFolder = Director::baseFolder()."/cms/";
        $frameworkBaseFolder = Director::baseFolder()."/framework/";
        foreach ($classes as $className) {
            $lowerClassName = strtolower($className);
            $location = $manifest[$lowerClassName];
            if (strpos($location, $cmsBaseFolder) === 0 || strpos($location, $frameworkBaseFolder) === 0) {
                continue;
            }
            if ($className != "Controller") {
                $controllerReflectionClass = new ReflectionClass($className);
                if (!$controllerReflectionClass->isAbstract()) {
                    if ($className instanceof SapphireTest ||
                       $className instanceof BuildTask ||
                       $className instanceof TaskRunner) {
                        continue;
                    }
                    $methods = $this->getPublicMethodsNotInherited($className);
                    foreach ($methods as $method) {
                        if ($method == strtolower($method)) {
                            if (strpos($method, "_") == null) {
                                if (!in_array($method, array("index", "run", "init"))) {
                                    $array[$className."_".$method] = array($className, $method);
                                }
                            }
                        }
                    }
                }
            }
        }
        $finalArray = array();
        $doubleLinks = array();
        foreach ($array as $index  => $classNameMethodArray) {
            if (stripos($classNameMethodArray[0], "Mailto") == null) {
                //ob_flush();
                //flush();
                $classObject = singleton($classNameMethodArray[0]);
                if ($classNameMethodArray[1] == "templateoverviewtests") {
                    $this->customLinks = array_merge($classObject->templateoverviewtests(), $this->customLinks);
                } else {
                    $link = Director::absoluteURL($classObject->Link($classNameMethodArray[1]));
                    if (!isset($doubleLinks[$link])) {
                        $finalArray[$index] = $link;
                    }
                    $doubleLinks[$link] = true;
                }
            }
        }
        return $finalArray;
    }

    private function getPublicMethodsNotInherited($className)
    {
        $classReflection = new ReflectionClass($className);
        $classMethods = $classReflection->getMethods();
        $classMethodNames = array();
        foreach ($classMethods as $index => $method) {
            if ($method->getDeclaringClass()->getName() !== $className) {
                unset($classMethods[$index]);
            } else {
                /* Get a reflection object for the class method */
                $reflect = new ReflectionMethod($className, $method->getName());
                /* For private, use isPrivate().  For protected, use isProtected() */
                /* See the Reflection API documentation for more definitions */
                if ($method->isPublic()) {
                    /* The method is one we're looking for, push it onto the return array */
                    $classMethodNames[] = $method->getName();
                }
            }
        }
        return $classMethodNames;
    }

    /**
     * Takes {@link #$classNames}, gets the URL of the first instance of it (will exclude extensions of the class) and
     * appends to the {@link #$urls} list to be checked
     * @return Array(String)
     */
    private function prepareClasses($publicOrAdmin = 0)
    {
        //first() will return null or the object
        $return = array();
        foreach ($this->classNames as $class) {
            $page = $class::get()->exclude(array("ClassName" => $this->arrayExcept($this->classNames, $class)))->first();
            if ($page) {
                if ($publicOrAdmin) {
                    $url = "/admin/pages/edit/show/".$page->ID;
                } else {
                    $url = $page->link();
                }
                $return[] = $url;
            }
        }
        return $return;
    }
}


/*
   Author:	Jamie Telin (jamie.telin@gmail.com), currently at employed Zebramedia.se

   Scriptname: W3C Validation Api v1.0 (W3C Markup Validation Service)

*/

class CheckAllTemplates_W3cValidateApi
{

    private $baseURL = 'http://validator.w3.org/check';
    private $output = 'soap12';
    private $uri = '';
    private $fragment = '';
    private $postVars = array();
    private $validResult = false;
    private $errorCount = 0;
    private $errorList = array();
    private $showErrors = true;


    private function W3cValidateApi()
    {
        //Nothing...
    }

    private function makePostVars()
    {
        $this->postVars['output'] = $this->output;
        if ($this->fragment) {
            $this->postVars['fragment'] = $this->fragment;
        } elseif ($this->uri) {
            $this->postVars['uri'] = $this->uri;
        }
    }

    private function setUri($uri)
    {
        $this->uri = $uri;
    }

    private function setFragment($fragment)
    {
        $fragment = preg_replace('/\s+/', ' ', $fragment);
        $this->fragment = $fragment;
    }

    private function makeValidationCall()
    {
        return $out;
    }

    private function validate()
    {
        sleep(1);

        $this->makePostVars();


        $user_agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
        $options = array(
            CURLOPT_CUSTOMREQUEST  =>"POST",        //set request type post or get
            CURLOPT_POST           =>1,            //set to GET
            CURLOPT_USERAGENT      => $user_agent, //"test from www.sunnysideup.co.nz",//$user_agent, //set user agent
            CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_POSTFIELDS     => $this->postVars,
            CURLOPT_URL            => $this->baseURL
        );
        // Initialize the curl session
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        // Execute the session and capture the response
        $out = curl_exec($ch);



        //$err               = curl_errno( $ch );
        //$errmsg            = curl_error( $ch );
        //$header            = curl_getinfo( $ch );
        $httpCode          = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode == 200) {
            $doc = simplexml_load_string($out);
            $doc->registerXPathNamespace('m', 'http://www.w3.org/2005/10/markup-validator');

            //valid ??
            $nodes = $doc->xpath('//m:markupvalidationresponse/m:validity');
            $this->validResult = strval($nodes[0]) == "true" ? true : false;

            //error count ??
            $nodes = $doc->xpath('//m:markupvalidationresponse/m:errors/m:errorcount');
            $this->errorCount = strval($nodes[0]);
            //errors
            $nodes = $doc->xpath('//m:markupvalidationresponse/m:errors/m:errorlist/m:error');
            foreach ($nodes as $node) {
                //line
                $nodes = $node->xpath('m:line');
                $line = strval($nodes[0]);
                //col
                $nodes = $node->xpath('m:col');
                $col = strval($nodes[0]);
                //message
                $nodes = $node->xpath('m:message');
                $message = strval($nodes[0]);
                $this->errorList[] = $message."($line,$col)";
            }
        }
        return $httpCode;
    }

    public function get_headers_from_curl_response($response)
    {
        return $header;
    }


    public function W3Validate($uri = "", $fragment = "")
    {
        if ($uri) {
            $this->setUri($uri);
        } elseif ($fragment) {
            $this->setFragment($fragment);
        }
        $this->validate();
        if ($this->validResult) {
            $type = 'PASS';
            $color1 = '#00CC00';
        } else {
            $type = 'FAIL';
            $color1 = '#FF3300';
        }
        $errorDescription = "";
        if ($this->errorCount) {
            $errorDescription = " - ".$this->errorCount."errors: ";
            if ($this->showErrors) {
                if (count($this->errorList)) {
                    $errorDescription .= "<ul><li>".implode("</li><li>", $this->errorList)."</li></ul>";
                }
            } else {
                $errorDescription .= '<a href="'.$this->baseURL.'?uri='.urlencode($uri).'">check</a>';
            }
        }

        return '<div style="background:'.$color1.';"><strong>'.$type.'</strong>'.$errorDescription.'</div>';
    }
}
