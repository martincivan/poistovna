<?php
/**
 * @service CalendarSoapClient
 */
class CalendarSoapClient{
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://labss2.fiit.stuba.sk/pis/ws/Calendar?WSDL';
	/**
	 * The PHP SoapClient object
	 *
	 * @var object
	 */
	public static $_Server=null;

	/**
	 * Send a SOAP request to the server
	 *
	 * @param string $method The method name
	 * @param array $param The parameters
	 * @return mixed The server response
	 */
	public static function _Call($method,$param){
		if(is_null(self::$_Server))
			self::$_Server=new SoapClient(self::$_WsdlUri);
		return self::$_Server->__soapCall($method,$param);
	}

	/**
	 * Vek cloveka
	 *
	 * @param int $birth_year
	 * @param int $birth_month
	 * @param int $birth_day
	 * @return int $vek
	 */
	public function calculateAge($birth_year,$birth_month,$birth_day){
		return self::_Call('calculateAge',Array(
			$birth_year,
			$birth_month,
			$birth_day
		));
	}

	/**
	 * Meniny
	 *
	 * @param int $month
	 * @param int $day
	 * @return string[] $mena
	 */
	public function getNames($month,$day){
		return self::_Call('getNames',Array(
			$month,
			$day
		));
	}

	/**
	 * Sunrise
	 *
	 * @param int $month
	 * @param int $day
	 * @return string $sunrise
	 */
	public function getSunrise($month,$day){
		return self::_Call('getSunrise',Array(
			$month,
			$day
		));
	}

	/**
	 * Sunset
	 *
	 * @param int $month
	 * @param int $day
	 * @return string $sunset
	 */
	public function getSunset($month,$day){
		return self::_Call('getSunset',Array(
			$month,
			$day
		));
	}

	/**
	 * Volny den
	 *
	 * @param int $month
	 * @param int $day
	 * @return boolean $is_free
	 */
	public function isFree($month,$day){
		return self::_Call('isFree',Array(
			$month,
			$day
		));
	}

	/**
	 * Weekend
	 *
	 * @param string $datetime
	 * @return boolean $je_vikend
	 */
	public function isWeekend($datetime){
		return self::_Call('isWeekend',Array(
			$datetime
		));
	}

	/**
	 * Current date
	 *
	 * @return string $date
	 */
	public function getCurrentDate(){
		return self::_Call('getCurrentDate',Array(
		));
	}

	/**
	 * Number of days
	 *
	 * @param string $date1 format: YYYY-MM-DD
	 * @param string $date2 format: YYYY-MM-DD
	 * @return int $days
	 */
	public function convertIntervalToDays($date1,$date2){
		return self::_Call('convertIntervalToDays',Array(
			$date1,
			$date2
		));
	}
}