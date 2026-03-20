<?php
/**
 * Initialize only if in the WordPress Admin area.
 */
if (is_admin()) {
    add_action('acf/init', 'tseg_global_url_utility_init');
}

function tseg_global_url_utility_init() {
    // 1. Inject the JS Controller into the footer
    add_action('admin_footer', 'tseg_global_url_utility_js');

    // 2. Register the AJAX endpoint
    add_action('wp_ajax_tseg_process_url_command', 'tseg_global_url_utility_ajax_handler');

    // 3. Filter the search results for both Relationship and Post Object fields
    add_filter('acf/fields/relationship/query', 'tseg_global_url_utility_query_filter', 10, 3);
    add_filter('acf/fields/post_object/query', 'tseg_global_url_utility_query_filter', 10, 3);
}

/**
 * The JavaScript Controller
 * Targets any ACF search input for Relationship or Post Object fields.
 */
function tseg_global_url_utility_js() {
    $nonce = wp_create_nonce('tseg_url_command_nonce');
    ?>
    <script type="text/javascript">
    jQuery(function($) {
        // Only run if ACF is present on the current admin page
        if (typeof acf === 'undefined') return;

        // Delegate listener to any ACF search input within Relationship or Post Object fields
        $(document).on('keydown', '.acf-field .acf-relationship input[data-filter="s"], .acf-field .acf-post-object input[data-filter="s"]', function(e) {
            if (e.keyCode !== 13) return; // Only trigger on Enter

            var $input = $(this);
            var inputText = $input.val().trim();
            
            // Check for "add {url}" or "remove {url}"
            var commandMatch = inputText.match(/^(add|remove)\s+(.*)/si);
            if (!commandMatch) return; 

            e.preventDefault();
            
            var command = commandMatch[1].toLowerCase();
            var urls = commandMatch[2].split(/\s*[,|\n]\s*/).filter(Boolean);
            var $fieldWrap = $input.closest('.acf-field');

            $input.addClass('acf-loading');

            $.post(ajaxurl, {
                action: 'tseg_process_url_command',
                nonce: '<?php echo $nonce; ?>',
                command: command,
                urls: urls
            })
            .done(function(response) {
                if (response.success && response.data.posts.length > 0) {
                    var posts = response.data.posts;
                    var fieldObj = acf.getField($fieldWrap);

                    // Logic for Relationship Field UI
                    if ($fieldWrap.hasClass('acf-field-relationship')) {
                        var $valuesList = $fieldWrap.find('.values-list');
                        var fieldName = $fieldWrap.find('.acf-relationship > input[type="hidden"]').attr('name');
                        if (fieldName && !fieldName.endsWith('[]')) fieldName += '[]';

                        posts.forEach(function(post) {
                            var exists = $valuesList.find('input[value="' + post.id + '"]').length > 0;
                            
                            if (command === 'add' && !exists) {
                                var newLi = `<li class="ui-sortable-handle"><input type="hidden" name="${fieldName}" value="${post.id}"><span data-id="${post.id}" class="acf-rel-item acf-rel-item-remove">${post.text}<a href="#" class="acf-icon -minus small dark" data-name="remove_item"></a></span></li>`;
                                $valuesList.append(newLi);
                                $fieldWrap.find('.choices .acf-rel-item-add[data-id="' + post.id + '"]').addClass('disabled');
                            } else if (command === 'remove' && exists) {
                                $valuesList.find('input[value="' + post.id + '"]').closest('li').remove();
                                $fieldWrap.find('.choices .acf-rel-item-add[data-id="' + post.id + '"]').removeClass('disabled');
                            }
                        });
                        
                        fieldObj.trigger('change');
                    }
                } else {
                    alert('No posts found for the provided URL(s).');
                }
            })
            .always(function() {
                $input.val('').removeClass('acf-loading').trigger('keyup');
            });
        });
    });
    </script>
    <?php
}

/**
 * AJAX Handler
 */
function tseg_global_url_utility_ajax_handler() {
    check_ajax_referer('tseg_url_command_nonce', 'nonce');

    $command = isset($_POST['command']) ? sanitize_text_field($_POST['command']) : 'add';
    $urls = isset($_POST['urls']) ? (array) $_POST['urls'] : [];
    $found_posts = tseg_get_post_data_by_urls($urls);

    if (!empty($found_posts)) {
        wp_send_json_success(['command' => $command, 'posts' => $found_posts]);
    }
    wp_send_json_error();
}

/**
 * PHP Query Filter
 * Helps the "Live Search" show the correct post when a URL is pasted (even without add/remove).
 */
function tseg_global_url_utility_query_filter($args, $field, $post_id) {
    $search = isset($args['s']) ? trim($args['s']) : '';
    if (empty($search)) return $args;

    // Clean "add " or "remove " from the string if user is using commands
    $clean_url_str = preg_replace('/^(add|remove)\s+/i', '', $search);
    $urls = str_contains($clean_url_str, ',') ? explode(',', $clean_url_str) : [$clean_url_str];

    $found_posts = tseg_get_post_data_by_urls($urls);

    if (!empty($found_posts)) {
        $args['post__in'] = wp_list_pluck($found_posts, 'id');
        $args['orderby'] = 'post__in';
        unset($args['s']); // Important: remove search string so WP doesn't look for the URL in the title
    }

    return $args;
}

/**
 * URL to ID Resolver
 */
function tseg_get_post_data_by_urls(array $urls): array {
    $found = [];
    foreach ($urls as $url) {
        $url = trim($url);
        if (empty($url)) continue;

        $id = 0;
        // Attempt 1: Direct URL to Post ID
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $id = url_to_postid($url);
        }

        // Attempt 2: Slug/Path to ID
        if (!$id) {
            $path = trim(wp_parse_url($url, PHP_URL_PATH), '/');
            if ($path) {
                $page = get_page_by_path($path, OBJECT, get_post_types(['public' => true]));
                if ($page) $id = $page->ID;
            }
        }

        if ($id) {
            $found[] = ['id' => $id, 'text' => get_the_title($id)];
        }
    }
    return array_unique($found, SORT_REGULAR);
}
