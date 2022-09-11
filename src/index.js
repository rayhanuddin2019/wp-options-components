

import { render } from '@wordpress/element';
import { Button, Modal } from '@wordpress/components';
import { useState } from '@wordpress/element';

import './css/index.scss';
const MyModal = () => {
	const [ isOpen, setOpen ] = useState( false );
	const openModal = () => setOpen( true );
	const closeModal = () => setOpen( false );

	return (
		<>
			<Button variant="secondary" onClick={ openModal }>
				Open Modal
			</Button>
			{ isOpen && (
				<Modal title="This is my modal" onRequestClose={ closeModal }>
					<Button variant="secondary" onClick={ closeModal }>
						My custom close button
					</Button>
				</Modal>
			) }
		</>
	);
};

const App = () => {
    return (
        <>
        <h3>React App</h3>
        <MyModal />
        </>
      
        );
}

render(<App toWhom="World" />,document.getElementById('qs-wp-settings-app'));
