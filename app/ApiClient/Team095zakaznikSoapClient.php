<?php
/**
 * @service Team095zakaznikSoapClient
 */

namespace App\ApiClient;

use SoapClient;

class Team095zakaznikSoapClient{
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://labss2.fiit.stuba.sk/pis/ws/Students/Team095zakaznik?WSDL';
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
	 * Ziskanie entity podla ID
	 *
	 * @param int $id id
	 * @return object $zakaznik @int=$id @string=$name @string=$heslo @string=$email @string=$adresa @date=$datum_narodenia @string=$meno @int=$komunikacia zakaznikType
	 */
	public function getById($id){
		return self::_Call('getById',Array(
			$id
		));
	}

	/**
	 * Ziskanie entit podla parametra
	 *
	 * @param string $attribute_name name of parameter
	 * @param string $attribute_value value of parameter
	 * @param int[] $ids list of entities for filtering
	 * @return object[] $zakazniks @int=$id @string=$name @string=$heslo @string=$email @string=$adresa @date=$datum_narodenia @string=$meno @int=$komunikacia zakaznikType
	 */
	public function getByAttributeValue($attribute_name,$attribute_value,$ids){
		return self::_Call('getByAttributeValue',Array(
			$attribute_name,
			$attribute_value,
			$ids
		));
	}

	/**
	 * Ziskanie entit podla ciselnej hodnoty
	 *
	 * @param string $attribute_name name of parameter
	 * @param string $attribute_value value of parameter
	 * @param string $math_condition mathematical condition (options: <, <=, =, >=, >)
	 * @param int[] $ids list of entities for filtering
	 * @return object[] $zakazniks @int=$id @string=$name @string=$heslo @string=$email @string=$adresa @date=$datum_narodenia @string=$meno @int=$komunikacia zakaznikType
	 */
	public function getByNumericCondition($attribute_name,$attribute_value,$math_condition,$ids){
		return self::_Call('getByNumericCondition',Array(
			$attribute_name,
			$attribute_value,
			$math_condition,
			$ids
		));
	}

	/**
	 * Ziskanie entit
	 *
	 * @return object[] $zakazniks @int=$id @string=$name @string=$heslo @string=$email @string=$adresa @date=$datum_narodenia @string=$meno @int=$komunikacia zakaznikType
	 */
	public function getAll(){
		return self::_Call('getAll',Array(
		));
	}

	/**
	 * @param string $team_id ID of team
	 * @param string $team_password heslo timu
	 * @param object $zakaznik @string=$name @string=$heslo @string=$email @string=$adresa @date=$datum_narodenia @string=$meno @int=$komunikacia zakaznikType
	 * @return int $id id
	 */
	public function insert($team_id,$team_password,$zakaznik){
		return self::_Call('insert',Array(
			$team_id,
			$team_password,
			$zakaznik
		));
	}

	/**
	 * @param string $team_id ID of team
	 * @param string $team_password heslo timu
	 * @param int $entity_id ID entity
	 * @param object $zakaznik @string=$name @string=$heslo @string=$email @string=$adresa @date=$datum_narodenia @string=$meno @int=$komunikacia zakaznikType
	 * @return int $updates pocet zmien
	 */
	public function update($team_id,$team_password,$entity_id,$zakaznik){
		return self::_Call('update',Array(
			$team_id,
			$team_password,
			$entity_id,
			$zakaznik
		));
	}

	/**
	 * @param string $team_id ID of team
	 * @param string $team_password heslo timu
	 * @param int $entity_id ID entity
	 * @return boolean $deleted stav
	 */
	public function delete($team_id,$team_password,$entity_id){
		return self::_Call('delete',Array(
			$team_id,
			$team_password,
			$entity_id
		));
	}
}

/**
 * zakaznik
 *
 * @pw_element int $id id
 * @pw_element string $name name
 * @pw_element string $heslo heslo
 * @pw_element string $email email
 * @pw_element string $adresa adresa
 * @pw_element date $datum_narodenia datum_narodenia
 * @pw_element string $meno meno
 * @pw_element int $komunikacia komunikacia
 * @pw_complex zakaznikType
 */
class zakaznikType{
	/**
	 * id
	 *
	 * @var int
	 */
	public $id;
	/**
	 * name
	 *
	 * @var string
	 */
	public $name;
	/**
	 * heslo
	 *
	 * @var string
	 */
	public $heslo;
	/**
	 * email
	 *
	 * @var string
	 */
	public $email;
	/**
	 * adresa
	 *
	 * @var string
	 */
	public $adresa;
	/**
	 * datum_narodenia
	 *
	 * @var date
	 */
	public $datum_narodenia;
	/**
	 * meno
	 *
	 * @var string
	 */
	public $meno;
	/**
	 * komunikacia
	 *
	 * @var int
	 */
	public $komunikacia;
}
