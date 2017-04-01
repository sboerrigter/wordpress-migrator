<?php

namespace Sboerrigter\WordPressMigrator\Migrate;

use wpdb;

class Importer
{
    private $user = 'user';
    private $password = 'pass';
    private $host = 'localhost';

    private $oldDatabaseName = 'database-old';
    private $oldPostsTable = 'wp_posts';
    private $oldPostMetaTable = 'wp_postmeta';
    private $oldDatabase;

    private $newDatabaseName = 'database-new';
    private $newPostsTable = 'wp_posts';
    private $newPostMetaTable = 'wp_postmeta';
    private $newDatabase;

    public function init()
    {
        $this->connect();
    }

    private function connect()
    {
        $this->oldDatabase = new wpdb($this->user, $this->password, $this->oldDatabaseName, $this->host);
        $this->newDatabase = new wpdb($this->user, $this->password, $this->newDatabaseName, $this->host);
    }

    public function getPosts($postType)
    {
        $posts = $this->oldDatabase->get_results("SELECT * FROM {$this->oldPostsTable} WHERE post_type='{$postType}'");

        return $posts;
    }

    public function getPostMeta($metaKey, $postId)
    {
        $customFields = $this->oldDatabase->get_results("SELECT * FROM {$this->oldPostMetaTable} WHERE post_id='{$postId}' AND meta_key='{$metaKey}'");

        if (!empty($customFields)) {
            return $customFields[0]->meta_value;
        } else {
            return null;
        }
    }

    public function getPostIdbyReferenceId($referenceId) {
        if (!$referenceId) {
            return;
        }

        $entry = $this->newDatabase->get_results("SELECT * FROM {$this->newPostMetaTable} WHERE meta_value='{$referenceId}'");
        $postId = array_shift($entry)->post_id;

        return $postId;
    }
}
