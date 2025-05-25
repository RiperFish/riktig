<?php

function render_svg_stars($rating)
{
    //$theme_url = get_template_directory_uri();
    $stars = min(5, round($rating)); // round and limit to max 5

    $out = '';

    for ($i = 0; $i < $stars; $i++) {
        $out .= '<img src="' . URL_BASE . '/images/star.svg" alt="★">';
    }

    return $out;
}



add_action('add_meta_boxes', function () {
    global $post;

    if (!is_object($post)) return;

    $template = get_page_template_slug($post->ID);

    // Change this to your specific template filename
    if ($template === 'home.php') {
        add_meta_box('custom_repeater', 'Custom Repeater', 'custom_repeater_meta_box', 'page');
    }
});

function custom_repeater_meta_box($post)
{
    $value = get_post_meta($post->ID, 'custom_repeater_field', true);
    $rows = is_array($value) ? $value : [];
    wp_nonce_field('save_custom_repeater', 'custom_repeater_nonce');
    wp_enqueue_media();
?>
    <div id="repeater-container">
        <?php foreach ($rows as $index => $row): ?>
            <div class="repeater-row">
                <input type="text" name="repeater[<?php echo $index; ?>][title]" value="<?php echo esc_attr($row['title'] ?? ''); ?>" placeholder="Title" />
                <input type="hidden" class="image-id" name="repeater[<?php echo $index; ?>][image]" value="<?php echo esc_attr($row['image'] ?? ''); ?>" />
                <img src="<?php echo esc_url(wp_get_attachment_url($row['image'] ?? 0)); ?>" class="image-preview" style="max-height: 50px; display: block;" />
                <button type="button" class="upload-image-button">Upload Image</button>
                <button type="button" class="remove-row">Remove</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" id="add-repeater-row">Add Row</button>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('repeater-container');
            const addBtn = document.getElementById('add-repeater-row');
            let mediaUploader;

            addBtn.addEventListener('click', () => {
                const index = container.children.length;
                const row = document.createElement('div');
                row.classList.add('repeater-row');
                row.innerHTML = `
                    <input type="text" name="repeater[\${index}][title]" placeholder="Title" />
                    <input type="hidden" class="image-id" name="repeater[\${index}][image]" />
                    <img src="" class="image-preview" style="max-height: 50px; display: none;" />
                    <button type="button" class="upload-image-button">Upload Image</button>
                    <button type="button" class="remove-row">Remove</button>
                `;
                container.appendChild(row);
            });

            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('.repeater-row').remove();
                }

                if (e.target.classList.contains('upload-image-button')) {
                    e.preventDefault();
                    const button = e.target;
                    const row = button.closest('.repeater-row');
                    const imageIdInput = row.querySelector('.image-id');
                    const preview = row.querySelector('.image-preview');

                    if (mediaUploader) {
                        mediaUploader.open();
                        return;
                    }

                    mediaUploader = wp.media({
                        title: 'Choose Image',
                        button: {
                            text: 'Select Image'
                        },
                        multiple: false
                    });

                    mediaUploader.on('select', function() {
                        const attachment = mediaUploader.state().get('selection').first().toJSON();
                        imageIdInput.value = attachment.id;
                        preview.src = attachment.url;
                        preview.style.display = 'block';
                    });

                    mediaUploader.open();
                }
            });
        });
    </script>
    <style>
        .repeater-row {
            margin-bottom: 10px;
        }

        .repeater-row input[type="text"] {
            margin-right: 10px;
        }

        .repeater-row button {
            margin-left: 5px;
        }
    </style>
<?php
}

add_action('save_post', function ($post_id) {
    if (!isset($_POST['custom_repeater_nonce']) || !wp_verify_nonce($_POST['custom_repeater_nonce'], 'save_custom_repeater')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $raw = $_POST['repeater'] ?? [];
    $clean = [];
    foreach ($raw as $row) {
        $clean[] = [
            'title' => sanitize_text_field($row['title'] ?? ''),
            'image' => intval($row['image'] ?? 0)
        ];
    }
    update_post_meta($post_id, 'custom_repeater_field', $clean);
});
add_shortcode('custom_repeater_display', function () {
    $post_id = get_the_ID();
    $repeater_data = get_post_meta($post_id, 'custom_repeater_field', true);
    if (empty($repeater_data)) return '';

    ob_start();
    echo '<div class="custom-repeater-wrapper">';
    foreach ($repeater_data as $row) {
        $title = esc_html($row['title']);
        $image_url = wp_get_attachment_image_url(intval($row['image']), 'medium');
        echo '<div class="custom-repeater-item">';
        if ($image_url) {
            echo '<img src="' . esc_url($image_url) . '" alt="' . $title . '" />';
        }
        echo '<h4>' . $title . '</h4>';
        echo '</div>';
    }
    echo '</div>';
    return ob_get_clean();
});

