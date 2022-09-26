import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

export default function save() {
	const blockProps = useBlockProps.save();
	return (
		<p {...blockProps}>
			{__(
				'Saved Block Attribute',
				'my-first-block'
			)
			
			}
			
		</p>
	);
}