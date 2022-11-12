<?php

// アイキャッチ画像をサポート
add_theme_support('post-thumbnails');

//サムネイルカラム追加
function customize_manage_posts_columns($columns)
{
    $columns['thumbnail'] = __('Thumbnail');
    return $columns;
}
add_filter('manage_posts_columns', 'customize_manage_posts_columns');

//サムネイル画像表示
function customize_manage_posts_custom_column($column_name, $post_id)
{
    if ('thumbnail' == $column_name) {
        $thum = get_the_post_thumbnail($post_id, 'small', array('style' => 'width:100px;height:auto;'));
    }
    if (isset($thum) && $thum) {
        echo $thum;
    } else {
        echo __('None');
    }
}
add_action('manage_posts_custom_column', 'customize_manage_posts_custom_column', 10, 2);

// スマホ表示分岐 
function is_mobile()
{
    $useragents = array(
        'iPhone',
        'iPod',
        'Android.*Mobile',
        'Windows.*Phone',
        'incognito',
        'webmate'
    );
    $pattern = '/' . implode('|', $useragents) . '/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

// 投稿ページで<img>タグの情報を書き換える
add_filter('the_content', function($content) {
    if ( is_single() | is_page() ) {
        $content = str_replace('<img', '<img class="lazyload opacity-0" ', $content);
        $content = str_replace('src="https://design-tomato', 'data-src="https://design-tomato', $content);
        return $content;
    };
});

//投稿者アーカイブにアクセスさせない
add_filter( 'author_rewrite_rules', '__return_empty_array' );
    function disable_author_archive() {
        if( $_GET['author'] || preg_match('#/author/.+#', $_SERVER['REQUEST_URI']) ){
        wp_redirect( home_url( '/404.php' ) );
        exit;
    }
}
add_action('init', 'disable_author_archive');

//管理画面メニューの不要項目削除
function remove_menus() {
    remove_menu_page( 'edit-comments.php' ); // コメント.
    remove_menu_page( 'tools.php' ); // ツール.
}
add_action( 'admin_menu', 'remove_menus', 999 );

// Head関連の記述
// global-styles-inline-css を非表示にする
add_action('wp_enqueue_scripts', 'remove_my_global_styles');
function remove_my_global_styles()
{
    wp_dequeue_style('global-styles');
}
// meta name="generator" を非表示にする
remove_action('wp_head', 'wp_generator');
// EditURIを非表示にする
remove_action('wp_head', 'rsd_link');
// wlwmanifestを非表示にする
remove_action('wp_head', 'wlwmanifest_link');
// 短縮URLを非表示にする
remove_action('wp_head', 'wp_shortlink_wp_head');
// 絵文字用JS・CSSを非表示にする
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
// コメントフィードを非表示にする
remove_action('wp_head', 'feed_links_extra', 3);
// dns-prefetchを非表示にする
add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);
function remove_dns_prefetch($hints, $relation_type)
{
    if ('dns-prefetch' === $relation_type) {
        return array_diff(wp_dependencies_unique_hosts(), $hints);
    }
    return $hints;
}
// wp versionを非表示にする
remove_action('wp_head','rest_output_link_wp_head');
//Gutenberg用CSSを非表示にする
function dequeue_plugins_style() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('liquid-block-speech');
    wp_dequeue_style('pochipp-front');
}
add_action( 'wp_enqueue_scripts', 'dequeue_plugins_style', 9999);
//jQueryを読み込まない
function delete_jquery() {
    wp_deregister_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'delete_jquery' );
