<?

/**
 * PeopleDate class file
 * 
 * @author Alekseenko Timur <zolter.od@gmail.com>
 * @link http://www.dbhelp.ru/
 * @copyright Copyright 2009
 */
class PeopleDate extends CWidget
{
	public $date;
        const FORMAT_SELECT_TIME=604800; // Неделя
	
	static function format($string, $format="%e %b. %Y")
	{
            if(!is_numeric($string)){
                $string=strtotime($string);
            }
            
            $ar=date("Y-m-d",$string);
            
            // выводим время в формате "сколько прошло"
            if($string > time()-self::FORMAT_SELECT_TIME and $string<time())
                return  self::getTimeAgo($string);
            
	    if (substr(PHP_OS,0,3) == 'WIN') {
	           $_win_from = array ('%e',  '%T',       '%D');
	           $_win_to   = array ('%#d', '%H:%M:%S', '%m/%d/%y');
	           $format = str_replace($_win_from, $_win_to, $format);
	    }
            
            $ar=date( $format,$string);
            $ar=date( $format,$string);
 	    
 	    if($string != '') {
	        $out = strftime($format, $string);
	    } else {
	        $out = '';
	    }
	    
		$strFrom = array(
				'january', 		'jan',	
				'february', 	'feb',	
				'march', 		'mar',	
				'april', 		'apr',	
				'may', 			'may',	
				'june',  	   'jun',	
				'july', 		'jul',	
				'august', 		'aug',	
				'september',	'sep',	
				'october',		'oct',	
				'november',		'nov',	
				'december',		'dec',
				'monday',	
				'tuesday',	
				'wednesday',	
				'thursday',	
				'friday',	
				'saturday',	
				'sunday',
				'mon',
				'tue',
				'wed',
				'thu',
				'fri',
				'sat',
				'sun',			
			);
			
                
                // Получаем данные из текущего файла языка
                $strTo = t('dates');
			
 		$outOld = $out;
 		
		$out = str_replace($strFrom, $strTo, strtolower($out));
 		if ($out == strtolower($outOld)){
			$out = $outOld;
		}
 		$out = str_replace('Май.', 'мая', $out);
 		return $out;	    
 	}

        /**
	 * Переводим TIMESTAMP в формат вида: 5 дн. назад
	 * или 1 мин. назад и тп.
	 *
	 * @param unknown_type $date_time
	 * @return unknown
	 */
	static function getTimeAgo($date_time)
	{
		$timeAgo = time() - $date_time;
		$timePer = array(
			'day' 	=> array(3600 * 24, 'дн.'),
			'hour' 	=> array(3600, ''),
			'min' 	=> array(60, 'мин.'),
			'sek' 	=> array(1, 'сек.'),
			);
		foreach ($timePer as $type =>  $tp) {
			$tpn = floor($timeAgo / $tp[0]);
			if ($tpn){
				
				switch ($type) {
					case 'hour':
						if (in_array($tpn, array(1, 21))){
							$tp[1] = 'час';
						}elseif (in_array($tpn, array(2, 3, 4, 22, 23)) ) {
							$tp[1] = 'часa';
						}else {
							$tp[1] = 'часов';
						}
						break;
				}
				return $tpn.' '.$tp[1].' назад';
			}
		}
	}
 } 
?>