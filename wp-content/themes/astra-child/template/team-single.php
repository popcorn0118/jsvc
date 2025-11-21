<?php
/**
 * Template Name: 團隊單頁面
 * Template Post Type: team
 * Description: 團隊單頁面
 */

get_header();
?>

<!-- 共用影片背景 -->
<main class="single-team" style="background-image: url(/wp-content/uploads/2025/11/bg-2.jpg);">
  <div class="single-team-warp">
    <?php 
    if ( have_posts() ) : while ( have_posts() ) : the_post();

      // 1) 精選圖（可能為 false）
      $img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );

      // 2) 標題
      $title = get_the_title();

      // 3) ACF 欄位（name_en）— 沒值回空字串
      $name_en   = function_exists('get_field') ? ( get_field('name_en')   ?: '' ) : ( get_post_meta(get_the_ID(), 'name_en',   true) ?: '' );

      // 4) 內容（走 the_content 濾器，讓短碼/嵌入生效）
      $content = apply_filters( 'the_content', get_the_content() );
    ?>

      <article id="post-<?php the_ID(); ?>" class="cont">
        <div class="team-header">
          <?php if ( $img_url ) : ?>
            <figure class="team-thumb">
              <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>">
            </figure>
          <?php endif; ?>
          <div class="team-title">
              <h1 class="name"><?php echo esc_html($title); ?></h1>
              <h6 class="name-en"><?php echo esc_html($name_en); ?></h6>
          </div>
        </div>

        <div class="team-content">
          <?php echo $content; ?>
        </div>

        <div class="back">
          <a href="<?php echo esc_url( home_url( '/our-team/' ) ); ?>" class="back-link">返回團隊列表</a>
        </div>

      </article>
      
    <?php endwhile; endif; ?>

    
  </div>
  
</main>






<?php get_footer(); ?>
