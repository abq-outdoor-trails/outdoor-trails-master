import { useState, useEffect } from 'react';

export const usePosition = () => {
	// initialize storage for position values or errors
	const [position, setPosition] = useState({});
	const [error, setError] = useState(null);

	// on change method
	const onChange = ({ coords }) => {
		setPosition({
			latitude: coords.latitude,
			longitude: coords.longitude,
		});
	};

	// on error method
	const onError = error => {
		setError(error.message);
	}

	// define useEffect
	useEffect(() => {
		const geo = navigator.geolocation;
		// check if browser is supporting geolocation
		if(!geo) {
			setError('Geolocation is not supported');
		}

		watcher = geo.watchPosition(onChange, onError);

		return () => geo.clearWatch(watcher);
	}, []);

	// return position values or error
	return {...position, error}
};