import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	BlockControls,
	__experimentalBlockAlignmentMatrixToolbar as BlockAlignmentMatrixToolbar,
	BlockAlignmentToolbar
} from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
	return (
		<div {...useBlockProps()}>
			{
			    <BlockControls>
					<BlockAlignmentToolbar 
					value={ attributes.textAlign }
					onChange={ ( nextAlign ) => {
					     setAttributes( { textAlign: nextAlign } );
					} } />	 	 
				</BlockControls>
			}
			<ServerSideRender
                    block="create-block/block-2"
                    attributes={ attributes }
            />
		</div>
	);
}