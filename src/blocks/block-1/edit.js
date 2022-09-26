import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	BlockControls,
	__experimentalBlockAlignmentMatrixToolbar as BlockAlignmentMatrixToolbar,
	BlockAlignmentToolbar
} from '@wordpress/block-editor';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	
	const blockProps = useBlockProps( {
		style: { color: '#e1e1e1', padding: '15px','text-align':attributes.textAlign }
		
	  } );
	  
	return (
		<p {...blockProps}>
			{
			    <BlockControls>
					<BlockAlignmentToolbar 
					value={ attributes.textAlign }
					onChange={ ( nextAlign ) => {
					     setAttributes( { textAlign: nextAlign } );
					} } />	 	 
				</BlockControls>
			}
			{__('Block Attribute!', 'my-first-block')}
			
		</p>
	);
}