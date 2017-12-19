<?php

namespace hermes\internal\repositories;

use \Object;
use opfx\data\IDbConnection;
use opfx\data\Db;
use hermes\internal\entities\Account;
use hermes\internal\collections\AccountSet;

class AccountRepository extends Object {
	private $loaded;

	/**
	 *
	 * @var IDbConnection
	 */
	private $conn;

	protected function __construct() {
		parent::__construct();
		$this->loaded = [ ];
	}

	static public function getInstance(): AccountRepository {
		static $instance = null;
		if ( is_null( $instance ) ) {
			$instance = new self();
		}
		return $instance;
	}

	public function getDatabaseConnection(): IDbConnection {
		if ( is_null( $this->conn ) ) {
			$this->conn = Db::getConnection( 'auth' );
		}
		return $this->conn;
	}

	public function load( AccountSet $set ) {
		$table = 'account';
		$sql = "SELECT * FROM $table";
		$conn = $this->getDatabaseConnection();
		$rows = $conn->execSql( $sql );
		foreach ( $rows as $row ) {
			$account = new Account( $this );
			$account->hydrate( $row );
			$this->loaded[$account->getKey()] = $account;
			$set->elements[$account->getKey()] = &$this->loaded[$account->getKey()];
		}
	}

	public function loadOne( Account $account ) {
		$table = 'account';
		$sql = "SELECT * FROM $table";
		$where = [ ];
		if ( $account->getKey() > 0 ) {
			$where[] = "`id`={$account->getKey()}";
		}
		if ( ! empty( $account->getUsername() ) ) {
			$where[] = "`username`='{$account->getUsername()}'";
		}

		if ( ! empty( $where ) ) {
			$where = implode( ',', $where );
			$sql .= " WHERE $where";
		}
		$conn = $this->getDatabaseConnection();
		$rows = $conn->execSql( $sql );
		foreach ( $rows as $row ) {
			$actual = new Account( $row['id'], $row['password'], $row['flags'], $this );
			$account->bind( $actual );
		}
	}

	public function createQuery() {
	}
}