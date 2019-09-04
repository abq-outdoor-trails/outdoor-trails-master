export default (state = [], action) => {
	switch(action.type) {
		case "GET_COMMENTS_BY_ROUTE_ID":
			return action.payload;
		default:
			return state;
	}
}
