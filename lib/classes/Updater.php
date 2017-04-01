<?php

namespace Sboerrigter\WordPressMigrator\Migrate;

class Updater
{
    private $postType;
    private $posts;
    private $currentPosts;

    public function init()
    {
        $this->currentPosts = new CurrentPosts();
    }

    public function saveNewPosts($posts, $postType)
    {
        $existing = $this->currentPosts->getReferences($postType);

        foreach ($posts as $post) {
            $post->post_type = $postType;

            if (! in_array($post->ID, $existing)) {
                $reference = $post->ID;
                $post->ID = 0;

                $postId = wp_insert_post($post);
                update_post_meta($postId, 'reference', $reference);

                echo ucfirst($postType) . ' saved: ' . $post->post_title . '</br>';
            }
        }
    }

    public function savePostMeta($value, $metaKey, $postId)
    {
        $currentValue = get_field($metaKey, $postId);

        if (empty($currentValue) && !empty($value)) {
            update_field($metaKey, $value, $postId);

            echo ucfirst($metaKey) . ' saved: ' . $value . '</br>';
        }
    }
}
