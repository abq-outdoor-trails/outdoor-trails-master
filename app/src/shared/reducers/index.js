import {combineReducers} from "redux"
import commentReducer from "./comment-reducer";
import userReducer from "./user-reducer";
import favoriteRouteReducer from "./favoriteRoute-reducer"

export default combineReducers({
	comments: commentReducer,
	user: userReducer,
	route: routeReducer,
	favoriteRoute: favoriteRouteReducer
})