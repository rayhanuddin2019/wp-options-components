

import { render } from '@wordpress/element';
import { Button, ColorPicker , Modal , TabPanel , __experimentalBorderControl as BorderControl } from '@wordpress/components';
import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import './css/index.scss';

const colors = [
    { name: 'Blue 20', color: '#72aee6' },
    
];

function CcolorPicker() {
    const [color, setColor] = useState();
    return (
        <ColorPicker
            color={color}
            onChange={setColor}
            enableAlpha
            defaultValue="#000"
        />
    );
}

const MyBorderControl = () => {
    const [ border, setBorder ] = useState();
    const onChange = ( newBorder ) => setBorder( newBorder );

    return (
        <BorderControl
            colors={ colors }
            label={ __( 'Border' ) }
            onChange={ onChange }
            value={ border }
        />
    );
};

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

const onSelect = ( tabName ) => {
    console.log( 'Selecting tab', tabName );
};

const MyTabPanel = () => (
    <TabPanel
        className="my-tab-panel"
        activeClass="active-tab"
        onSelect={ onSelect }
        tabs={ [
            {
                name: 'tab1',
                title: 'Tab 1',
                className: 'tab-one',
            },
            {
                name: 'tab2',
                title: 'Tab 2',
                className: 'tab-two',
            },
        ] }
    >
        { ( tab ) => <p>{ tab.title }</p> }
    </TabPanel>
);

const App = () => {
    return (
        <>
        <h3>React App</h3>
        <MyModal />
		 <MyTabPanel/>
		 <MyBorderControl />
		 <CcolorPicker />
        </>
      
        );
}

render(<App toWhom="World" />,document.getElementById('qs-wp-settings-app'));
