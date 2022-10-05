<?php


//Blocks

function qs_register_block_first() {

    if ( ! function_exists( 'register_block_type' ) ) {
        // Block editor is not available.
        return;
    }

	if(!file_exists(WP_SETTINGS_FR_DIR_PATH . 'build/blocks')){
       return;
	}
	
	$blocks = moption_ready_get_dir_list('blocks');
	if(is_array($blocks)){
		foreach($blocks as $item){
			
            $get_render_attr  = mo_get_block_attr($item,['render_callback']);
            if(is_array( $get_render_attr )){
                register_block_type( WP_SETTINGS_FR_DIR_PATH . 'build/blocks/'.$item, $get_render_attr );	    
            }else{
                register_block_type( WP_SETTINGS_FR_DIR_PATH . 'build/blocks/'.$item);	    
            } 
			
		
		}
	}
    
	// register_block_type( WP_SETTINGS_FR_DIR_PATH . 'build/blocks/block-1' );
	// register_block_type( WP_SETTINGS_FR_DIR_PATH . 'build/blocks/block-2' );
	// //register_block_type( WP_SETTINGS_FR_DIR_PATH . 'build/blocks/block-3' );
}

// Hook: Editor assets.
add_action( 'init', 'qs_register_block_first' );


