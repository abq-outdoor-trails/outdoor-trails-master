import React, { useState } from 'react';
import ReactMapGL from 'react-map-gl';

export const Map = () => {
	const [viewport, setViewport] = useState({
		latitude: 35.0844444,
		longitude: -106.6505556,
		width: '50vw',
		height: '50vh',
		zoom: 10
	});

	return (
		<div>
			<ReactMapGL {...viewport}>markers here</ReactMapGL>
		</div>
	)
}