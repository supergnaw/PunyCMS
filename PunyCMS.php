<?php
  class PunyCMS extends Linchpin {
    // vars
    private $cols = array( 'entry_id', 'created', 'edited', 'created_by', 'edited_by', 'category', 'title', 'content' );

    // constructor
    public function __construct() {
      // database functions
      parent::__construct();
      // create class table
      $this->create_entry_table();
    }

    // add entry
    public function add_entry( $category, $title, $content, $author, $created = null ) {
      // verify data set
      if( empty( $category )) {
        $this->err[] = "Missing data for PunyCMS entry: 'Category'";
        return false;
      }
      if( empty( $title )) {
        $this->err[] = "Missing data for PunyCMS entry: 'Title'";
        return false;
      }
      if( empty( $content )) {
        $this->err[] = "Missing data for PunyCMS entry: 'Content'";
        return false;
      }
      if( empty( $author )) {
        $this->err[] = "Missing data for PunyCMS entry: 'Author'";
        return false;
      }

      // create query
      $sql = "INSERT INTO `punycms_entries` (
                `category`,
                `title`,
                `content`,
                `created_by`,
                `edited_by`,
                `created`
              ) VALUES (
                :category,
                :title,
                :content,
                :created_by,
                :edited_by,
                :created
              );";

      // prepare variables
      $params['category'] = trim( $category );
      $params['title'] = trim( $title );
      $params['content'] = trim( $content );
      $params['created_by'] = trim( $author );
      $params['edited_by'] = ( !empty( $author )) ? trim( $author ) : trim( $author );
      $params['created'] = ( !empty( $created )) ? date( 'Y-m-d H:i:s', strtotime( trim( $created ))) : date( 'Y-m-d H:i:s' );

      // execute
      return $this->sqlexec( $sql, $params );
    }

    // search entries
    public function search_entries( $search ) {
      $sql = "SELECT * FROM `punycms_entries`
              WHERE `category` LIKE :search
              OR `title` LIKE :search
              OR `content` LIKE :search;";
      $params = array( 'search' => "%{$search}%" );
      return $this->sqlexec( $sql, $params );
    }

    // edit entry
    public function edit_entry( $entryID, $category, $title, $content, $editor ) {
      // verify data set
      if( empty( $entryID )) {
        $this->err[] = "Missing data for PunyCMS entry: 'Entry ID'";
        return false;
      }
      if( empty( $category )) {
        $this->err[] = "Missing data for PunyCMS entry: 'Category'";
        return false;
      }
      if( empty( $title )) {
        $this->err[] = "Missing data for PunyCMS entry: 'Title'";
        return false;
      }
      if( empty( $content )) {
        $this->err[] = "Missing data for PunyCMS entry: 'Content'";
        return false;
      }
      if( empty( $editor )) {
        $this->err[] = "Missing data for PunyCMS entry: 'Editor'";
        return false;
      }

      // create query
      $sql = "UPDATE `punycms_entries` SET
                `category` = :category,
                `title` = :title,
                `content` = :content,
                `edited_by` = :edited_by
              WHERE `entry_id` = :entry_id;";

      // prepare variables
      $params['entry_id'] = trim( $entryID );
      $params['category'] = trim( $category );
      $params['title'] = trim( $title );
      $params['content'] = trim( $content );
      $params['edited_by'] = trim( $editor );

      // execute
      return $this->sqlexec( $sql, $params );
    }

    // delete entry
    public function delete_entry( $entryID ) {

    }

    // create entry table
    public function create_entry_table() {
      $sql = "CREATE TABLE IF NOT EXISTS `punycms_entries` (
                `entry_id` INT NOT NULL AUTO_INCREMENT ,
                `created` DATETIME NOT NULL ,
                `edited` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                `created_by` VARCHAR( 256 ) NOT NULL ,
                `edited_by` VARCHAR( 256 ) NOT NULL ,
                `category` VARCHAR( 256 ) NOT NULL ,
                `title` VARCHAR( 512 ) NOT NULL ,
                `content` MEDIUMTEXT NOT NULL ,
                PRIMARY KEY ( `entry_id` ),
                UNIQUE KEY `title` (`title`)
              ) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
      $res = $this->sqlexec( $sql );
    }

    // get table entries
    public function fetch_entry_table( $orderBy = null, $sort = null ) {
      if( empty( $orderBy ) || empty( $sort )) {
        $sql = "SELECT * FROM `punycms_entries` ORDER BY `created` ASC;";
      } else {
        if( in_array( $orderBy, $this->cols )) {
          $sort = ( in_array( strtoupper( $sort ), array( 'ASC', 'DESC' ))) ? strtoupper( $sort ) : 'ASC';
          $sql = "SELECT * FROM `punycms_entries` ORDER BY `{$orderBy}` {$sort};";
        } else {
          $sql = "SELECT * FROM `punycms_entries` ORDER BY `created` ASC;";
        }
      }
      $res = $this->sqlexec( $sql );
      return $res;
    }

    // get entry by ID
    public function fetch_entry( $entryID ) {
      $sql = "SELECT * FROM `punycms_entries` WHERE `entry_id` = :entryID;";
      $res = $this->sqlexec( $sql, array( 'entryID' => $entryID ));
      if( count( $res ) != 1 ) {
        return false;
      } else {
        return $res[0];
      }
    }

    // get all entries of a certain category
    public function fetch_entries_by_category( $category, $orderBy = null, $sort = null ) {
      if( empty( $orderBy ) || empty( $sort )) {
        $sql = "SELECT * FROM `punycms_entries` WHERE `category` = :category ORDER BY `created` ASC;";
      } else {
        if( in_array( $orderBy, $this->cols )) {
          $sort = ( in_array( strtoupper( $sort ), array( 'ASC', 'DESC' ))) ? strtoupper( $sort ) : 'ASC';
          $sql = "SELECT * FROM `punycms_entries` WHERE `category` = :category ORDER BY {$col} {$sort};";
        } else {
          $sql = "SELECT * FROM `punycms_entries` WHERE `category` = :category ORDER BY `created` ASC;";
        }
      }
      $res = $this->sqlexec( $sql, array( 'category' => $category ));
      return $res;
    }
  }
