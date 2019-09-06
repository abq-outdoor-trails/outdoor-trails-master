export default (state = [], action) => {
	switch(action.type) {
		case "GET_USER_BY_USER_ID":
			return [...state, action.payload];
		default:
			return state;
	}
}