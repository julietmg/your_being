<?php


namespace Jet_Form_Builder\Db_Queries;

use Jet_Form_Builder\Db_Queries\Exceptions\Sql_Exception;

abstract class Base_Db_Model {

	const DB_TABLE_PREFIX = 'jet_fb_';
	const InnoDB          = 'InnoDB';
	const MyISAM          = 'MyISAM';

	protected static $prefix = self::DB_TABLE_PREFIX;

	protected $silence = false;

	/**
	 * Returns table name
	 *
	 * @return [type] [description]
	 */
	abstract public static function table_name(): string;

	/**
	 * Returns columns schema
	 *
	 * @return [type] [description]
	 */
	abstract public static function schema(): array;

	/**
	 * Returns schemas options
	 * Such as primary keys, charset
	 *
	 * @return [type] [description]
	 */
	abstract public static function schema_keys(): array;

	public static function schema_columns( $prefix = '' ): array {
		$columns = array();

		foreach ( array_keys( static::schema() ) as $column ) {
			$item = sprintf( '`%s`.`%s`', static::table(), $column );

			if ( $prefix ) {
				$item .= sprintf( " as '%s'", "{$prefix}.{$column}" );
			}

			$columns[] = array( 'as' => $item );
		}

		return $columns;
	}


	public function create(): Base_Db_Model {
		Execution_Builder::instance()->safe_create( $this );

		return $this;
	}

	/**
	 * This method is used to create foreign keys.
	 * And this is safe as the model will create
	 * the outer table before it creates the current one.
	 *
	 * P.S. see
	 *  - \Jet_Form_Builder\Db_Queries\Base_Db_Model::before_create
	 *  - \Jet_Form_Builder\Db_Queries\Execution_Builder::create
	 *
	 * @return Base_Db_Constraint[]
	 */
	public function foreign_relations(): array {
		return array();
	}

	/**
	 * @param array $columns
	 *
	 * @param null $format
	 *
	 * @return int
	 * @throws Sql_Exception
	 */
	public function insert( $columns = array(), $format = null ): int {
		return Execution_Builder::instance()->insert( $this, $columns, $format );
	}

	public function insert_soft( $columns = array(), $format = null ): int {
		try {
			return $this->insert( $columns, $format );
		} catch ( Sql_Exception $exception ) {
			return 0;
		}
	}

	/**
	 * @param $multi_columns
	 * @param null $format
	 *
	 * @return int[]
	 * @throws Sql_Exception
	 */
	public function insert_many( $multi_columns, $format = null ) {
		$inserted_ids = array();
		foreach ( $multi_columns as $columns ) {
			if ( ! is_array( $columns ) || empty( $columns ) ) {
				continue;
			}
			$inserted_ids[] = $this->insert( $columns );
		}

		return $inserted_ids;
	}

	/**
	 * @param $columns
	 * @param $where
	 * @param null $format
	 * @param null $where_format
	 *
	 * @return int
	 * @throws Sql_Exception
	 */
	public function update( $columns, $where, $format = null, $where_format = null ): int {
		return Execution_Builder::instance()->update( $this, $columns, $where, $format, $where_format );
	}

	public function update_soft( $columns, $where, $format = null, $where_format = null ): int {
		try {
			return $this->update( $columns, $where, $format, $where_format );
		} catch ( Sql_Exception $exception ) {
			return 0;
		}
	}

	/**
	 * @param $where
	 * @param null $format
	 *
	 * @return int
	 * @throws Sql_Exception
	 */
	public function delete( $where, $format = null ) {
		return Execution_Builder::instance()->delete( $this, $where, $format );
	}

	public function get_defaults(): array {
		$defaults    = array();
		$schema_keys = array_keys( static::schema() );

		if ( in_array( 'created_at', $schema_keys, true ) ) {
			$defaults['created_at'] = current_time( 'mysql' );
		}

		return $defaults;
	}

	public function before_create() {
		$this->create_foreign_tables();
	}

	protected function create_foreign_tables() {
		Execution_Builder::instance()->create_foreign_tables( $this );
	}

	public function after_create() {
	}

	public function before_insert() {
		$this->create();
	}

	public function after_insert( $insert_columns ) {
	}

	public function before_update() {
	}

	public function update_columns( array $columns ): array {
		$schema_keys = array_keys( static::schema() );

		if ( in_array( 'updated_at', $schema_keys, true )
			&& ! array_key_exists( 'updated_at', $columns )
		) {
			$columns['updated_at'] = current_time( 'mysql' );
		}
		return $columns;
	}

	/**
	 * @throws Sql_Exception
	 */
	public function before_delete() {
		if ( ! current_user_can( 'manage_options' ) ) {
			throw new Sql_Exception(
				"Not enough capabilities for current user to delete rows in {$this::table()}"
			);
		}
	}

	public function schema_charset_collate() {
		return $this->wpdb()->get_charset_collate();
	}

	public function schema_engine() {
		return self::InnoDB;
	}

	/**
	 * You must you this function,
	 * to get right name of table
	 *
	 * @return string table name
	 */
	public static function table() {
		return static::wpdb()->prefix . static::$prefix . static::table_name();
	}

	/**
	 * @param bool $silence
	 *
	 * @return Base_Db_Model
	 */
	public function set_silence( bool $silence ): Base_Db_Model {
		$this->silence = $silence;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function is_silence(): bool {
		return $this->silence;
	}

	/**
	 * Returns WPDB instance
	 *
	 * @return \QM_DB|\wpdb [description]
	 */
	public static function wpdb() {
		global $wpdb;

		return $wpdb;
	}

}
