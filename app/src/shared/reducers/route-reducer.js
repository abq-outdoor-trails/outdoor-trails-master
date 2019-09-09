export default (state = [], action) => {
	switch(action.type) {
		case "GET_ROUTE_BY_ROUTE_ID":
			return action.payload;
		case "GET_ROUTE_BY_ROUTE_TYPE":
			return [action.payload];
		case "GET_ROUTE_BY_ROUTE_NAME":
			return action.payload;
		default:
			return state;
	}
}