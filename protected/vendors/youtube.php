<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * PHP sample code for the YouTube data API.  Utilizes the Zend Framework
 * Zend_Gdata component to communicate with the YouTube data API.
 *
 * Requires the Zend Framework Zend_Gdata component and PHP >= 5.1.4
 * This sample is run from within a web browser.  These files are required:
 * session_details.php - a script to view log output and session variables
 * operations.php - the main logic, which interfaces with the YouTube API
 * index.php - the HTML to represent the web UI, contains some PHP
 * video_app.css - the CSS to define the interface style
 * video_app.js - the JavaScript used to provide the video list AJAX interface
 *
 * NOTE: If using in production, some additional precautions with regards
 * to filtering the input data should be used.  This code is designed only
 * for demonstration purposes.
 */
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_App_Exception');

/*
 * The main controller logic.
 *
 * POST used for all authenticated requests
 * otherwise use GET for retrieve and supplementary values
 */
generateUrlInformation();

/**
 * Create upload form by sending the incoming video meta-data to youtube and
 * retrieving a new entry. Prints form HTML to page.
 *
 * @param string $VideoTitle The title for the video entry.
 * @param string $VideoDescription The description for the video entry.
 * @param string $VideoCategory The category for the video entry.
 * @param string $VideoTags The set of tags for the video entry (whitespace separated).
 * @param string $nextUrl (optional) The URL to redirect back to after form upload has completed.
 * @return void
 */
function createUploadForm($videoTitle, $videoDescription, $videoCategory, $videoTags, $nextUrl = null)
{
    $httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);
    $newVideoEntry = new Zend_Gdata_YouTube_VideoEntry();

    $newVideoEntry->setVideoTitle($videoTitle);
    $newVideoEntry->setVideoDescription($videoDescription);

    //make sure first character in category is capitalized
    $videoCategory = strtoupper(substr($videoCategory, 0, 1))
        . substr($videoCategory, 1);
    $newVideoEntry->setVideoCategory($videoCategory);

    // convert videoTags from whitespace separated into comma separated
    $videoTagsArray = explode(' ', trim($videoTags));
    $newVideoEntry->setVideoTags(implode(', ', $videoTagsArray));

    $tokenHandlerUrl = 'http://gdata.youtube.com/action/GetUploadToken';
    try {
        $tokenArray = $youTubeService->getFormUploadToken($newVideoEntry, $tokenHandlerUrl);
    } catch (Zend_Gdata_App_HttpException $httpException) {
        print 'ERROR ' . $httpException->getMessage()
            . ' HTTP details<br /><textarea cols="100" rows="20">'
            . $httpException->getRawResponseBody()
            . '</textarea><br />'
            . '<a href="session_details.php">'
            . 'click here to view details of last request</a><br />';
        return;
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not retrieve token for syndicated upload. '
            . $e->getMessage()
            . '<br /><a href="session_details.php">'
            . 'click here to view details of last request</a><br />';
        return;
    }

    $tokenValue = $tokenArray['token'];
    $postUrl = $tokenArray['url'];

    // place to redirect user after upload
    if (!$nextUrl) {
        $nextUrl = $_SESSION['homeUrl'];
    }

    print <<< END
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script src="js/ajaxfileupload.js" type="text/javascript"></script>
    <form name="form" id="form-send" action="" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="yttoken" id="yttoken" value="${tokenValue}"><input type="hidden" name="yturl" id="yturl" value="${postUrl}?nexturl=${nextUrl}">
		<input id="fileToUpload" type="file" size="15" name="fileToUpload" class="input"><button class="button" id="buttonUpload">Залить</button><div id="loader"></div>
	</form>
END;
}

/**
 * Convenience method to obtain an authenticted Zend_Http_Client object.
 *
 * @return Zend_Http_Client An authenticated client.
 */
function getAuthSubHttpClient()
{
    $_SESSION['developerKey'] = 'developerKey';
    try {
        $username     = 'username@gmail.com';
        $password     = 'password';
        $serviceName = Zend_Gdata_YouTube::AUTH_SERVICE_NAME;
        $applicationName = 'Application Name';

        $httpClient = Zend_Gdata_ClientLogin::getHttpClient($username, $password, $serviceName, null, $applicationName);
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not obtain authenticated Http client object. '
            . $e->getMessage();
        return;
    }
    $httpClient->setHeaders('X-GData-Key', 'key='. $_SESSION['developerKey']);
    return $httpClient;
}

/**
 * Store location of the demo application into session variables.
 *
 * @return void
 */
function generateUrlInformation()
{
    if (!isset($_SESSION['operationsUrl']) || !isset($_SESSION['homeUrl'])) {
        $_SESSION['operationsUrl'] = 'http://'. $_SERVER['HTTP_HOST']
                                   . $_SERVER['PHP_SELF'];
        $path = explode('/', $_SERVER['PHP_SELF']);
        $path[count($path)-1] = 'index.php';
        $_SESSION['homeUrl'] = 'http://'. $_SERVER['HTTP_HOST']
                             . implode('/', $path);
    }
}

/**
 * Log a message to the session variable array.
 *
 * @param string $message The message to log.
 * @param string $messageType The type of message to log.
 * @return void
 */
function logMessage($message, $messageType)
{
    if (!isset($_SESSION['log_maxLogEntries'])) {
        $_SESSION['log_maxLogEntries'] = 20;
    }

    if (!isset($_SESSION['log_currentCounter'])) {
        $_SESSION['log_currentCounter'] = 0;
    }

    $currentCounter = $_SESSION['log_currentCounter'];
    $currentCounter++;

    if ($currentCounter > $_SESSION['log_maxLogEntries']) {
        $_SESSION['log_currentCounter'] = 0;
    }

    $logLocation = 'log_entry_'. $currentCounter . '_' . $messageType;
    $_SESSION[$logLocation] = $message;
    $_SESSION['log_currentCounter'] = $currentCounter;
}

/**
 * Create upload form by sending the incoming video meta-data to youtube and
 * retrieving a new entry. Prints form HTML to page.
 *
 * @param CUploadedFile $file The uploaded video file.
 * @param string $VideoTitle The title for the video entry.
 * @param string $VideoDescription The description for the video entry.
 * @param string $VideoCategory The category for the video entry.
 * @param string $VideoTags The set of tags for the video entry (whitespace separated).
 * @param string $nextUrl (optional) The URL to redirect back to after form upload has completed.
 * @return void
 */
function Upload(CUploadedFile $file, $videoTitle, $videoDescription, $videoCategory, $videoTags, $nextUrl = null)
{
    $httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);
    $newVideoEntry = new Zend_Gdata_YouTube_VideoEntry();
    $videoTitle = check_desc($videoTitle);
    $videoDescription = check_desc($videoDescription);

    $filesource = $youTubeService->newMediaFileSource($file->getTempName());
    $filesource->setContentType($file->getType());
    $filesource->setSlug($file->getTempName());

    $newVideoEntry->setMediaSource($filesource);

    $newVideoEntry->setVideoTitle($videoTitle);
    $newVideoEntry->setVideoDescription($videoDescription);

    //make sure first character in category is capitalized
    $videoCategory = strtoupper(substr($videoCategory, 0, 1))
        . substr($videoCategory, 1);
    $newVideoEntry->setVideoCategory($videoCategory);

    // convert videoTags from whitespace separated into comma separated
    $videoTagsArray = explode(' ', trim($videoTags));
    $newVideoEntry->setVideoTags(implode(', ', $videoTagsArray));

    // Upload URI for the currently authenticated user
    $uploadUrl =
        'http://uploads.gdata.youtube.com/feeds/users/default/uploads';

    // Try to upload the video, catching a Zend_Gdata_App_HttpException
    // if availableor just a regular Zend_Gdata_App_Exception

    try {
        $newEntry = $youTubeService->insertEntry($newVideoEntry,
                                      $uploadUrl,
                                      'Zend_Gdata_YouTube_VideoEntry');
    } catch (Zend_Gdata_App_HttpException $httpException) {
      echo $httpException->getRawResponseBody();
    } catch (Zend_Gdata_App_Exception $e) {
      echo $e->getMessage();
    }

    return $newEntry->getVideoId();
}

function parse($content,$begin, $end)
{
  $pos = ($begin)?strpos($content, $begin)+strlen($begin):0;
  $content = substr($content, $pos);
  $pos = strpos($content, $end);
  $content = substr($content, 0, $pos);
  return $content;
}

function check_desc($desc)
{
  $desc = substr($desc,0,800); //Резать все после 800 символов
  $desc = ($tmp=parse($desc,'<p>','</p>'))?$tmp:$desc;  //Только первый параграф
  $desc = ($tmp=parse($desc,'',"\n"))?$tmp:$desc;  //До первого переноса строки
  $desc = preg_replace ("'<[\/\!]*?[^<>]*?>'si", '', $desc); // Вырезаются html-тэги
  if ( strlen($desc) > 250 )
  {
    $small = substr($desc,0,250);
    $more = substr($desc, 250);
    $desc = ($tmp=parse($more,'','.'))?$small.$tmp.'.':$desc; //До первой точки
  }
  return $desc;
}