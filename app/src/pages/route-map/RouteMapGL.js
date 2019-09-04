import React, { useState, useEffect } from 'react';
import {useSelector, useDispatch} from "react-redux";
import ReactMapGL, {Marker} from 'react-map-gl';
import {httpConfig} from "../../shared/utils/http-config";
import {getRouteByRouteType} from "../../shared/actions/get-route";

export const Map = () => {
	const [viewport, setViewport] = useState({
		latitude: 35.0844444,
		longitude: -106.6505556,
		width: '50vw',
		height: '50vh',
		zoom: 10
	});

	// return the routes store from redux and store in routes variable (is this necessary?)
	const routes = useSelector(state => state.route ? state.route : []);

	const dispatch = useDispatch();

	const effects = () => {
		// the dispatch function takes actions as arguments to change the store
		dispatch(getRouteByRouteType());
	};

	// declare inputs that will be used by functions that are declared in effects
	const inputs = [routeType];

	/**
	 **/

	useEffect(effects, inputs);

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
				<Marker latitude={routes.latitude} longitude={routes.longitude}>
					<div>ROUTE</div>
				</Marker>
			</ReactMapGL>
		</div>

	)
};