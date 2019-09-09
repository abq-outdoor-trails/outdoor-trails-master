import React, {useEffect} from 'react';
import _ from 'lodash';

import ReactMapboxGl, {Layer, Feature, MapContext} from 'react-mapbox-gl';
import {useDispatch, useSelector} from "react-redux";
import {getRouteByRouteType} from "../../actions/get-route";
import ZoomControl from "react-mapbox-gl";

export const HomeMap = () => {
    const Map = ReactMapboxGl({
        accessToken: 'pk.eyJ1Ijoid2hhcnJpcyIsImEiOiJjanp3cmVkdHMwMnkzM2JwbThiYXd3YWJtIn0.LYO1SzQdH7Q8p1as8N3dMA',
    });

    const routeType = "Paved Multiple Use Trail - A paved trail closed to automotive traffic.";

    const routes = useSelector(state => (state.route[0] ? state.route[0] : []));

    console.log(routes);

    const dispatch = useDispatch();

    const effects = () => {
        dispatch(getRouteByRouteType(routeType));
    };

    const inputs = [routeType];

    useEffect(effects, inputs);

    return (
        <Map
            style="mapbox://styles/mapbox/streets-v9"
            containerStyle={{
                height: '50vh',
                width: '50vw'
            }}
            center={[-106.6505556, 35.0844444]}
            zoom={[10]}
        >
            <ZoomControl/>
            <Layer
                type="line"
                layout={{
                    'line-cap': 'round',
                    'line-join': 'round'
                }}
                paint={{
                    'line-color': '#4790E5',
                    'line-width': 4
                }}
                >
                {/*{MAP GOES HERE}*/}
            </Layer>

        </Map>
    )
};