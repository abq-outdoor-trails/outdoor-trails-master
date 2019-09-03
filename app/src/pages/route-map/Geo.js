import * as React from 'react';
import ReactMapGL, {Marker} from 'react-map-gl';
import { geolocated } from 'react-geolocated';

import * as routeData from "../../image/biketrails_wgs84.json";

class Geo extends React.Component {
	render() {
		return !this.props.isGeolocationAvailable ? (
			<div>Your browser does not support Geolocation</div>
		) : !this.props.isGeolocationAvailable ? (
			<div>Geolocation is not enabled</div>
		) : this.props.coords ? (
			<table>
				<tbody>
				<tr>
					<td>latitude</td>
					<td>{this.props.coords.latitude}</td>
				</tr>
				<tr>
					<td>longitude</td>
					<td>{this.props.coords.longitude}</td>
				</tr>
				</tbody>
			</table>
		) : (
			<div>Getting the location data&hellip;</div>
		);
	}
}

export default Geo;