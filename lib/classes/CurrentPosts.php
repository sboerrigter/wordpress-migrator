<?php

namespace Sboerrigter\WordPressMigrator\Migrate;

class CurrentPosts
{
    public function get($postType)
    {
        $currentPosts = get_posts([
            'post_type'      => $postType,
            'post_status'    => 'any',
            'posts_per_page' => -1,
        ]);

        return $currentPosts;
    }

    public function getReferences($postType)
    {
        $currentPosts = $this->get($postType);
        $references = [];

        foreach ($currentPosts as $currentPost) {
            $reference = get_post_meta($currentPost->ID, 'reference', true);

            if ($reference) {
                $references[] = $reference;
            }
        }

        return $references;
    }
}
