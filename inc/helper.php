<?php

function mo_option_fix_path( $path ) {

	$windows_network_path = isset( $_SERVER['windir'] ) && in_array( substr( $path, 0, 2 ),
			array( '//', '\\\\' ),
			true );
	$fixed_path           = untrailingslashit( str_replace( array( '//', '\\' ), array( '/', '/' ), $path ) );

	if ( empty( $fixed_path ) && ! empty( $path ) ) {
		$fixed_path = '/';
	}

	if ( $windows_network_path ) {
		$fixed_path = '//' . ltrim( $fixed_path, '/' );
	}

	return $fixed_path;
}

function mo_get_block_attr($block,$return_attr = ['render_callback']){
    
	if($block == ''){
	  return false;
	}

    if(!is_array($return_attr)){
        return false;
    }

    if(!file_exists(mo_option_fix_path(WP_SETTINGS_FR_DIR_PATH . 'build/blocks/'.$block.'/block.json'))){
      return false;  
	}

	$return_data = []; 
	$data = wp_json_file_decode(mo_option_fix_path(WP_SETTINGS_FR_DIR_PATH . 'build/blocks/'.$block.'/block.json'), ['associative' => true]); 	
   
    foreach( $return_attr as $key ){
      if(isset($data[$key]) && $data[$key] !=''){
        $return_data[$key] = $data[$key];
      }
    }

    if(empty($return_data)){
        return false;
    }
    
    return $return_data;
}

function moption_ready_get_dir_list($path = 'blocks'){

	$widgets_modules = [];
	$dir_path        = WP_SETTINGS_FR_DIR_PATH."build/".$path;
	$dir             = new \DirectoryIterator($dir_path);
	 
	 foreach ($dir as $fileinfo) {
		 if ($fileinfo->isDir() && !$fileinfo->isDot()) {
			 $widgets_modules[$fileinfo->getFilename()] = $fileinfo->getFilename();
			
		 }
	 }

	 return $widgets_modules;
}