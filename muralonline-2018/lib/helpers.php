<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/*
Original wp_terms_checklist()
From https://core.trac.wordpress.org/browser/tags/4.9.6/src/wp-admin/includes/template.php#L77
 */
function whq_terms_checklist( $post_id = 0, $args = array() ) {
    /** Walker_Category_Checklist class */
    require_once( ABSPATH . 'wp-admin/includes/class-walker-category-checklist.php' );
    /** WP_Internal_Pointers class */
    require_once( ABSPATH . 'wp-admin/includes/class-wp-internal-pointers.php' );

    $defaults = array(
        'descendants_and_self' => 0,
        'selected_cats' => false,
        'popular_cats' => false,
        'walker' => null,
        'taxonomy' => 'category',
        'checked_ontop' => true,
        'echo' => true,
    );

    /**
     * Filters the taxonomy terms checklist arguments.
     *
     * @since 3.4.0
     *
     * @see whq_terms_checklist()
     *
     * @param array $args    An array of arguments.
     * @param int   $post_id The post ID.
     */
    $params = apply_filters( 'whq_terms_checklist', $args, $post_id );

    $r = wp_parse_args( $params, $defaults );

    if ( empty( $r['walker'] ) || ! ( $r['walker'] instanceof Walker ) ) {
        $walker = new Walker_Category_Checklist;
    } else {
        $walker = $r['walker'];
    }

    $taxonomy = $r['taxonomy'];
    $descendants_and_self = (int) $r['descendants_and_self'];

    $args = array( 'taxonomy' => $taxonomy );

    //$tax = get_taxonomy( $taxonomy );
    //$args['disabled'] = ! current_user_can( $tax->cap->assign_terms );

    $args['list_only'] = ! empty( $r['list_only'] );

    if ( is_array( $r['selected_cats'] ) ) {
        $args['selected_cats'] = $r['selected_cats'];
    } elseif ( $post_id ) {
        $args['selected_cats'] = wp_get_object_terms( $post_id, $taxonomy, array_merge( $args, array( 'fields' => 'ids' ) ) );
    } else {
        $args['selected_cats'] = array();
    }
    if ( is_array( $r['popular_cats'] ) ) {
        $args['popular_cats'] = $r['popular_cats'];
    } else {
        $args['popular_cats'] = get_terms( $taxonomy, array(
            'fields' => 'ids',
            'orderby' => 'count',
            'order' => 'DESC',
            'number' => 10,
            'hierarchical' => false
        ) );
    }
    if ( $descendants_and_self ) {
        $categories = (array) get_terms( $taxonomy, array(
            'child_of' => $descendants_and_self,
            'hierarchical' => 0,
            'hide_empty' => 0
        ) );
        $self = get_term( $descendants_and_self, $taxonomy );
        array_unshift( $categories, $self );
    } else {
        $categories = (array) get_terms( $taxonomy, array( 'get' => 'all' ) );
    }

    $output = '';

    if ( $r['checked_ontop'] ) {
        // Post process $categories rather than adding an exclude to the get_terms() query to keep the query the same across all posts (for any query cache)
        $checked_categories = array();
        $keys = array_keys( $categories );

        foreach ( $keys as $k ) {
            if ( in_array( $categories[$k]->term_id, $args['selected_cats'] ) ) {
                $checked_categories[] = $categories[$k];
                unset( $categories[$k] );
            }
        }

        // Put checked cats on top
        $output .= call_user_func_array( array( $walker, 'walk' ), array( $checked_categories, 0, $args ) );
    }
    // Then the rest of them
    $output .= call_user_func_array( array( $walker, 'walk' ), array( $categories, 0, $args ) );

    if ( $r['echo'] ) {
        echo $output;
    }

    return $output;
}
