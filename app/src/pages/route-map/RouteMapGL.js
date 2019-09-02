import React, { useState } from 'react';
import ReactMapGL, {Marker} from 'react-map-gl';
import * as routeData from "../../image/biketrails_wgs84.json";

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
				{routeData.default.features[0].geometry.paths[0].map(route =>(
					<Marker latitude={35.082103870000026} longitude={-106.53200461099999}>
						<div>ROUTE</div>
					</Marker>
				))}
				{console.log(routeData.default.features[0].geometry.paths[0])}
			</ReactMapGL>
		</div>
	)
};