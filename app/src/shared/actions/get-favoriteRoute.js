import {httpConfig} from "../utils/http-config";
import {} // I may need another import statement here

export const getFavoriteRouteByFavoriteRouteRouteIdAndFavoriteRouteUserId = () => dispatch => {
	const {data} =await httpConfig('/apis/favoriteRoute/');
	dispatch({type: "GET_FAVORITE_ROUTE_BY_FAVORITE_ROUTE_ROUTE_ID_AND_FAVORITE_ROUTE_USER_ID"})
};

export const getFavoriteRoutesByRouteId = () => dispatch => {
	const {data} =await httpConfig('/apis/favoriteRoute/');
	dispatch({type: "GET_FAVORITE_ROUTES_BY_ROUTE_ID"})
};

export const getFavoriteRoutesByUserId = () => dispatch => {
	await dispatch(getFavoriteRoutesByRouteId());

	const userId =_.uniq(_.map(getState().route, "favoriteRouteRouteId"));
	routeId.forEach(id => dispatch(getFavoriteRoutesByRouteId()));

};