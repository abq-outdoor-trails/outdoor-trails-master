export default (state = [], action) => {
	switch(action.type) {
		case "GET_COMMENT_BY_COMMENT_ID":
			return action.payload
	}
}
