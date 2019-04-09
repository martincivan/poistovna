<?php
/**
 * @service Team095produktSoapClient
 */


class Team095produktSoapClient{
	/**
	 * The WSDL URI
	 *
	 * @var string
	 */
	public static $_WsdlUri='http://labss2.fiit.stuba.sk/pis/ws/Students/Team095produkt?WSDL';
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
	 * @return object $produkt @int=$id @string=$name @string=$nazov @double=$cena @date=$zaciatok @date=$koniec @date=$schvalene @string=$popis produktType
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
	 * @return object[] $produkts @int=$id @string=$name @string=$nazov @double=$cena @date=$zaciatok @date=$koniec @date=$schvalene @string=$popis produktType
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
	 * @return object[] $produkts @int=$id @string=$name @string=$nazov @double=$cena @date=$zaciatok @date=$koniec @date=$schvalene @string=$popis produktType
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
	 * @return object[] $produkts @int=$id @string=$name @string=$nazov @double=$cena @date=$zaciatok @date=$koniec @date=$schvalene @string=$popis produktType
	 */
	public function getAll(){
		return self::_Call('getAll',Array(
		));
	}

	/**
	 * @param string $team_id ID of team
	 * @param string $team_password heslo timu
	 * @param object $produkt @string=$name @string=$nazov @double=$cena @date=$zaciatok @date=$koniec @date=$schvalene @string=$popis produktType
	 * @return int $id id
	 */
	public function insert($team_id,$team_password,$produkt){
		return self::_Call('insert',Array(
			$team_id,
			$team_password,
			$produkt
		));
	}

	/**
	 * @param string $team_id ID of team
	 * @param string $team_password heslo timu
	 * @param int $entity_id ID entity
	 * @param object $produkt @string=$name @string=$nazov @double=$cena @date=$zaciatok @date=$koniec @date=$schvalene @string=$popis produktType
	 * @return int $updates pocet zmien
	 */
	public function update($team_id,$team_password,$entity_id,$produkt){
		return self::_Call('update',Array(
			$team_id,
			$team_password,
			$entity_id,
			$produkt
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
 * produkt
 *
 * @pw_element int $id id
 * @pw_element string $name name
 * @pw_element string $nazov nazov
 * @pw_element double $cena cena
 * @pw_element date $zaciatok zaciatok
 * @pw_element date $koniec koniec
 * @pw_element date $schvalene schvalene
 * @pw_element string $popis popis
 * @pw_complex produktType
 */
class produktType{
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
	 * nazov
	 *
	 * @var string
	 */
	public $nazov;
	/**
	 * cena
	 *
	 * @var double
	 */
	public $cena;
	/**
	 * zaciatok
	 *
	 * @var date
	 */
	public $zaciatok;
	/**
	 * koniec
	 *
	 * @var date
	 */
	public $koniec;
	/**
	 * schvalene
	 *
	 * @var date
	 */
	public $schvalene;
	/**
	 * popis
	 *
	 * @var string
	 */
	public $popis;
}
