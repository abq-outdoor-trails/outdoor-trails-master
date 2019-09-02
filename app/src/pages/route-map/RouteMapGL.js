import React, { useState } from 'react';
import ReactMapGL, {Merker} from 'react-map-gl';
import * as routeData from "../../image/biketrails_wgs84";

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
			<ReactMapGL
				{...viewport}
				mapboxApiAccessToken="pk.eyJ1Ijoid2hhcnJpcyIsImEiOiJjanp3cmVkdHMwMnkzM2JwbThiYXd3YWJtIn0.LYO1SzQdH7Q8p1as8N3dMA"
				mapStyle="mapbox://styles/wharris/ck02siyy56po81cqxw9u87ulw"
				onViewportChange={viewport => {
					setViewport(viewport);
				}}
			>
				{routeData.geometry.paths.map(route => (
					<Marker key={route.attributes.OBJECTID}>
						<div>ROUTE</div>
					</Marker>
				))}
			</ReactMapGL>
		</div>
	)
}