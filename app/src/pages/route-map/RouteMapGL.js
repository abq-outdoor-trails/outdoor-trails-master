import React, { useState } from 'react';
import ReactMapGL, {Marker} from 'react-map-gl';
import { usePosition } from 'use-position';

import * as routeData from "../../image/biketrails_wgs84.json";

export const Map = () => {
	const [viewport, setViewport] = useState({
		latitude: 35.0844444,
		longitude: -106.6505556,
		width: '50vw',
		height: '50vh',
		zoom: 10
	});

	const { latitude2, longitude2, timestamp, accuracy, error } = usePosition(true);

	return (
		<div>
			<ReactMapGL
				{...viewport}
				mapboxApiAccessToken="pk.eyJ1Ijoid2hhcnJpcyIsImEiOiJjanp3cmVkdHMwMnkzM2JwbThiYXd3YWJtIn0.LYO1SzQdH7Q8p1as8N3dMA"
				mapStyle="mapbox://styles/wharris/ck02siyy56po81cqxw9u87ulw"
				onViewportChange={viewport => {
					setViewport(viewport);
				}}
			>
				<Marker latitude={routeData.default.features[0].geometry.paths[0][0][1]} longitude={routeData.default.features[0].geometry.paths[0][0][0]}>
					<div>ROUTE</div>
				</Marker>
				<Marker latitude={routeData.default.features[0].geometry.paths[0][1][1]} longitude={routeData.default.features[0].geometry.paths[0][1][0]}>
					<div>ROUTE</div>
				</Marker>
				{console.log(routeData.default.features[0].geometry.paths[0][0][0])}
				{console.log(routeData.default.features[0].geometry.paths[0][0][1])}
			</ReactMapGL>
			<code>
				latitude: {latitude2}<br/>
				longitude: {longitude2}<br/>
				timestamp: {timestamp}<br/>
				accuracy: {accuracy && `${accuracy}m`}<br/>
				error: {error}
			</code>
		</div>

	)
};