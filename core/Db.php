<?php

namespace core;

use PDO;

class Db{
	protected $db;

	function __construct()
	{
		/**
		 * Database config
		 */
		$this->db = new PDO('mysql:host=db;dbname=links', 'root', '123');
	}
	/**
	 * This method make prepare query to database
	 * @param $sql string - sql query to database
	 * @param $params Array - arguments, which will be sent in sql query
	 */
	public function query($sql, $params = []) {
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			/**
			 * Binding values from $params
			 */
			foreach ($params as $key => $val) {
				if (is_int($val)) {

					$type = PDO::PARAM_INT;
				} else {
					$type = PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $val, $type);
			}
		}
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * Prepare insert in database
	 * @param string $table - name of table
	 * @param string $cols - column of table, which need to be inserted
	 * @param string $value - VALUES(value1, value2 ...)
	 * @param array $params - aruments which need to pass in sql query
	 */
	public function insert($table,$cols,$values,$params)
	{
		/**
		 * Formatting strings to prepare to send in sql query
		 */
		$cols = '('.$cols.')';
		$values = '('.$values.')';
		$stmt = $this->db->prepare("INSERT INTO $table $cols VALUES $values");
		/**
		 * Binding values
		 */
		foreach ($params as $key => $val) {
				if (is_int($val)) {

					$type = PDO::PARAM_INT;
				} else {
					$type = PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $val, $type);
			}
		$stmt->execute();


	}
}