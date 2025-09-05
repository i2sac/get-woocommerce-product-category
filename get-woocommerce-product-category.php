<?php
/**
 * @package GetProductCategoryPlugin
 */
/*
Plugin Name: Get WooCommerce Product Category
Plugin URI: https://github.com/louisisaacdiouf/get-woocommerce-product-category
Description: A WordPress plugin that returns the main category of a given WooCommerce product.
Version: 1.0.0
Author: Louis Isaac Diouf
Author URI: https://github.com/louisisaacdiouf
Licence: GPLv2
*/

function_exists('add_action') or die("Avada kedavra!");

add_action('wp_ajax_get_product_category', 'get_product_category_callback');
add_action('wp_ajax_nopriv_get_product_category', 'get_product_category_callback');

function get_product_category_callback() {
  if (isset($_POST['product_id'])) {
      $product_id = intval($_POST['product_id']);
      $product = wc_get_product($product_id);
      
      if ($product) {
          $categories = wp_get_post_terms($product->get_id(), 'product_cat');
          
          // Retournez la liste des catégories
          if (!empty($categories)) {
              $category_names = wp_list_pluck($categories, 'name');
              echo implode(', ', $category_names);
          } else {
              echo "";
          }
      }
  }
  
  die();
}
