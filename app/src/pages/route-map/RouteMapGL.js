import React, {Component} from 'react';
import ReactMapGL from 'react-map-gl';

export class Map extends Component {
	state = {
		viewport: {
			width: 400,
			height: 400,
			latitude: 35.0844444,
			longitude: -106.6505556,
			zoom: 8
		}
	};

	render() {
		return (
			<ReactMapGL
				{...this.state.viewport}
				onViewportChange={viewport => this.setState({viewport})}
			/>
		);
	}
}