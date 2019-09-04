import { useCurrentPosition } from 'react-use-geolocation';
import React from 'react';

function Example() {
	const [position, error] = useCurrentPosition();

	if (!position && !error) {
		return <p>Waiting...</p>;
	}

	if (error) {
		return <p>{error.message}</p>;
	}

	return (
		<div>
			<p>
				Latitude: {position.coords.latitude}
			</p>
			<p>
				Longitude: {position.coords.longitude}
			</p>
		</div>
	);
}