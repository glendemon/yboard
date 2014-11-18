<?php
/**
 * this widget render inside your page a video from
 * youtube, megavideo, veoh or vimeo
 * @author Nicola Puddu
 */
class Yiitube extends CWidget {
	
	/**
	 * these constants rappresent the possible status of the widget
	 * @var int
	 */
	const OK = 0;
	const NO_VIDEO_CODE = 1;
	const NO_VIDEO_CODE_IN_URL = 2;
	const NO_SUPPORTED_PLAYER = 3;
	/**
	 * these constants rappresent the available players
	 * @var string the player name
	 */
	const YOUTUBE = 'youtube';
	const MEGAVIDEO = 'megavideo';
	const VIMEO = 'vimeo';
	const VEOH = 'veoh';
	
	/**
	 * @var array possible standard heights of a youtube video
	 */
	private $_height = array(
						'youtube'=>array(
							'small' => 349,
							'normal' => 390,
							'big' => 510,
							'huge' => 750,
						),
						'megavideo'=>array(
							'small' => 330,
							'normal' => 344,
							'big' => 430,
							'huge' => 551,
						),
						'vimeo'=>array(
							'small' => 225,
							'normal' => 360,
							'big' => 450,
							'huge' => 576
						),
						'veoh'=>array(
							'small' => 340,
							'normal' => 510,
							'big' => 680,
							'huge' => 850,
						),
					);
	/**
	 * @var array possible standard widths of a youtube video
	 */
	private $_width = array(
						'youtube'=>array(
							'small' => 560,
							'normal' => 640,
							'big' => 853,
							'huge' => 1280,
						),
						'megavideo'=>array(
							'small' => 450,
							'normal' => 640,
							'big' => 800,
							'huge' => 1024,
						),
						'vimeo'=>array(
							'small' => 400,
							'normal' => 640,
							'big' => 800,
							'huge' => 1024,
						),
						'veoh'=>array(
							'small' => 410,
							'normal' => 615,
							'big' => 820,
							'huge' => 1025,
						),
					);
	/**
	 * @var int the current status. possible values are those of the constants
	 */
	private $_status;
	
	/**
	 * @var string the player to use to display the video
	 */
	public $player = 'youtube';
	/**
	 * when setting this parameter you can either use the video code or the whole url.
	 * @var string the youtube video you want to display.
	 */
	public $v;
	/**
	 * @var string size options for the video
	 * @example small, normal, big, huge
	 */
	public $size = 'normal';
	/**
	 * @var bool if you want to display the video in HD or not. Defaults to false.
	 */
	public $hd = false;
	
	/**
	 * check the integrity of the video code when initialized
	 * @see CWidget::init()
	 */
	public function init()
	{
		parent::init();
		// set default status
		$this->_status = self::OK;
		// check if the selected player is supported
		$this->playerSupport();
		// check the video code
		if ($this->v != NULL) {
			if (filter_var($this->v, FILTER_VALIDATE_URL))
				$this->v = $this->getVideoCode();
		} else
			$this->_status = self::NO_VIDEO_CODE;
	}

	/**
	 * display the video
	 * @see CWidget::run()
	 */
	public function run()
	{
		if ($this->_status === self::OK) {
			$method = strtolower($this->player).'Code';
			echo $this->$method();
		} else
			echo '<b>'.$this->renderError().'</b>';
	}
	
	/**
	 * checks if yiitube is supporting the desired player
	 * @return bool
	 */
	protected function playerSupport()
	{
		switch (strtolower($this->player)) {
			case self::YOUTUBE:
				return true;	
				break;
			case self::MEGAVIDEO:
				return true;
				break;
			case self::VIMEO:
				return true;
				break;
			case self::VEOH:
				return true;
				break;
			default:
				$this->_status = self::NO_SUPPORTED_PLAYER;
				return false;
				break;
		}
	}
	
	/**
	 * @return string the youtube iframe according to the settings
	 */
	protected function youtubeCode()
	{
		return <<<YOUTUBE
		<iframe title="YouTube video player" width="{$this->_width[self::YOUTUBE][$this->size]}" height="{$this->_height[self::YOUTUBE][$this->size]}" 
		src="{$this->youtubeVideoURL()}" frameborder="0" allowfullscreen></iframe>
YOUTUBE;
	}
	
	/**
	 * @return string the megavideo object code according to the settings
	 */
	protected function megavideoCode()
	{
		return <<<MEGAVIDEO
		<object width="{$this->_width[self::MEGAVIDEO][$this->size]}" height="{$this->_height[self::MEGAVIDEO][$this->size]}">
			<param name="movie" value="http://www.megavideo.com/v/{$this->v}"></param>
			<param name="allowFullScreen" value="true"></param>
			<embed src="http://www.megavideo.com/v/{$this->v}" type="application/x-shockwave-flash" allowfullscreen="true" width="{$this->_width[self::MEGAVIDEO][$this->size]}" height="{$this->_height[self::MEGAVIDEO][$this->size]}"></embed>
		</object>
MEGAVIDEO;
	}
	
	/**
	 * @return string the vimeo iframe code according to the settings
	 */
	protected function vimeoCode()
	{
		return <<<VIMEO
		<iframe src="http://player.vimeo.com/video/21339058?byline=0&amp;portrait=0" width="{$this->_width[self::VIMEO][$this->size]}" height="{$this->_height[self::VIMEO][$this->size]}" frameborder="0"></iframe>
VIMEO;
	}
	
	/**
	 * @return string the veoh code according to the settings
	 */
	protected function veohCode()
	{
		return <<<VEOH
		<object width="{$this->_width[self::VEOH][$this->size]}" height="{$this->_height[self::VEOH][$this->size]}" id="veohFlashPlayer" name="veohFlashPlayer">
			<param name="movie" value="http://www.veoh.com/static/swf/veoh/MediaPlayerWrapper.swf?version=&permalinkId={$this->v}&player=videodetailsembedded&videoAutoPlay=0&id=anonymous"></param>
			<param name="allowFullScreen" value="true"></param>
			<param name="allowscriptaccess" value="always"></param>
			<embed src="http://www.veoh.com/static/swf/veoh/MediaPlayerWrapper.swf?version=&permalinkId={$this->v}&player=videodetailsembedded&videoAutoPlay=0&id=anonymous" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="{$this->_width[self::VEOH][$this->size]}" height="{$this->_height[self::VEOH][$this->size]}" id="veohFlashPlayerEmbed" name="veohFlashPlayerEmbed"></embed>
		</object>
VEOH;
	}
	 
	/**
	 * @return string the video url that has to be used inside the iframe
	 */
	protected function youtubeVideoURL()
	{
		$url = "http://www.youtube.com/embed/{$this->v}?rel=0";
		if ($this->hd)
			$url .= '&amp;hd=1';
		return $url;
	}
	
	/**
	 * search into the provided url for the player video code.
	 * @return string the player video code
	 */
	protected function getVideoCode()
	{
		switch (strtolower($this->player)) {
			case self::VIMEO:
				$video_code = substr(parse_url($this->v, PHP_URL_PATH), 1);
				if ($video_code)
					 return $video_code;
				break;
			case self::VEOH:
				$video_code = substr(parse_url($this->v, PHP_URL_PATH), 7);
				if ($video_code)
					 return $video_code;
				break;
			default:
				$get_vars  = explode('&', html_entity_decode(parse_url($this->v, PHP_URL_QUERY)));
				foreach($get_vars as $var) {
					$exploded_var = explode('=', $var);
					if ($exploded_var[0] === 'v')
						return $exploded_var[1];
				}
				break;
		}
		$this->_status = self::NO_VIDEO_CODE_IN_URL;
		return false;	
	}
	
	/**
	 * @return string the error message to be displayed
	 */
	protected function renderError()
	{
		switch ($this->_status) {
			case self::NO_VIDEO_CODE:
				return Yii::t('yiitube', 'you need to set a video code to use this widget.<br/>Check the online documentation.');
				break;
			case self::NO_VIDEO_CODE_IN_URL:
				return Yii::t('yiitube', 'the URL you provided does not contain a youtube video code.');
				break;
			case self::NO_SUPPORTED_PLAYER:
				return Yii::t('yiitube', 'Yiitube doesn\'t support {player}', array('{player}' => $this->player));
				break;
		}
	}

}