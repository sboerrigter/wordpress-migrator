<?php
/**
 * WordPress content migrator
 *
 * Usage: Just uncomment below what you would like to migrate and visit
 * this file to start the migration. Preferably via your commandline to prevent
 * timeouts. Only new posts and postmeta will be imported. Allready imported
 * posts and postmeta will not get updated.
 *
 * Be patient ;-).
 */

namespace Sboerrigter\WordPressMigrator\Migrate;

require_once(dirname(dirname(__FILE__)) . '/wp/wp-load.php');
include_once('lib/autoloader.php');

$migrator = new Migrator();
$migrator->init();

/**
 * Migrate posts
 */
// $migrator->migratePosts('post', 'post');
// $migrator->migratePostMeta('old_key', 'new_key', 'post');
// $migrator->migrateImage('old_key', 'new_key', 'post');

/**
 * Migrate Yoast SEO data (for posts)
 */
// $migrator->migratePostMeta('_yoast_wpseo_focuskw', '_yoast_wpseo_focuskw', 'post');
// $migrator->migratePostMeta('_yoast_wpseo_title', '_yoast_wpseo_title', 'post');
// $migrator->migratePostMeta('_yoast_wpseo_metadesc', '_yoast_wpseo_metadesc', 'post');
// $migrator->migratePostMeta('_yoast_wpseo_linkdex', '_yoast_wpseo_linkdex', 'post');

/**
 * Migrate pages
 */
// $migrator->migratePosts('page', 'page');

/**
 * Migrate media
 */
// $migrator->migratePosts('attachment', 'attachment');
// $migrator->migratePostMeta('_wp_attached_file', '_wp_attached_file', 'attachment');
// $migrator->migratePostMeta('_wp_attachment_metadata', '_wp_attachment_metadata', 'attachment');

echo 'Migration completed :-)';
