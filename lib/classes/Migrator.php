<?php
namespace Sboerrigter\WordPressMigrator\Migrate;

class Migrator
{
    private $importer;
    private $updater;
    private $currentPosts;

    public function init()
    {
        $this->importer = new Importer();
        $this->importer->init();

        $this->updater = new Updater();
        $this->updater->init();

        $this->currentPosts = new CurrentPosts();
    }

    public function migratePosts($oldPostType, $newPostType)
    {
        $posts = $this->importer->getPosts($oldPostType);
        $this->updater->saveNewPosts($posts, $newPostType);
    }

    public function migratePostmeta($oldKey, $newKey, $postType)
    {
        $currentPosts = $this->currentPosts->get($postType);

        foreach ($currentPosts as $currentPost) {
            $reference = get_post_meta($currentPost->ID, 'reference', true);
            $value = $this->importer->getPostMeta($oldKey, $reference);
            $this->updater->savePostMeta($value, $newKey, $currentPost->ID);
        }
    }

    public function migrateImage($oldKey, $newKey, $postType)
    {
        $currentPosts = $this->currentPosts->get($postType);

        foreach ($currentPosts as $currentPost) {
            $reference = get_post_meta($currentPost->ID, 'reference', true);
            $value = $this->importer->getPostMeta($oldKey, $reference);
            $value = $this->importer->getPostIdbyReferenceId($value);

            $this->updater->savePostMeta($value, $newKey, $currentPost->ID);
        }
    }
}
