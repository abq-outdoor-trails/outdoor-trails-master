// export default (state = [], action) => {
// 	switch(action.type) {
// 		case "GET_FAVORITE_ROUTE_BY_FAVORITE_ROUTE_ROUTE_ID_AND_FAVORITE_ROUTE_USER_ID":
// 			return action.payload;
// 		default:
// 			return state;
// 	}
// }

export default (state = [], action) => {
	switch(action.type) {
		case "GET_FAVORITE_ROUTES_BY_ROUTE_ID":
			return action.payload;
		default:
			return state;
	}
}

