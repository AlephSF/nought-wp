@php
  $postId = isset($postId) && $postId ? $postId : $post->ID;
  $imageSize = isset($imageSize) && $imageSize ? $imageSize : 'thumbnail';
  $attachmentId = get_post_thumbnail_id($postId);
  $imgSrc = wp_get_attachment_image_src($attachmentId, $imageSize);
  $imgSizes = wp_get_attachment_image_sizes($attachmentId, $imageSize);
  $imgSrcset = wp_get_attachment_image_srcset($attachmentId, $imgSizes);
  $imgAlt = get_post_meta($attachmentId, '_wp_attachment_image_alt', true);
@endphp

@if($imgSrc)
  <img src="{!! esc_url($imgSrc[0]) !!}"
    srcset="{!! esc_attr($imgSrcset) !!}"
    sizes="{!! esc_attr($imgSizes) !!}"
    alt="{!! esc_attr($imgAlt) !!}"
  />
@endif
