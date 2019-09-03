import { useState, useEffect } from 'react';

export const usePosition = () => {
	// initialize storage for position values or errors
	const [position, setPosition] = useState({});
	const [error, setError] = useState(null);

	// return position values or error
	return {...position, error}
};