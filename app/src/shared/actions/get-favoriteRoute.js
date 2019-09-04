import {httpConfig} from "../utils/http-config";

export const getFavoriteRouteByFavoriteRouteRouteIdAndFavoriteRouteUserId = () => dispatch => {
	const {data} =await httpConfig('/apis/favoriteRoute/');
	dispatch({type: "GET_FAVORITE_ROUTE_BY_FAVORITE_ROUTE_ROUTEID_AND_FAVORITE_ROUTE_USER_ID"})
};

export const getFavoriteRoutesByRouteId = () => dispatch => {
	const {data} =await httpConfig('/apis/favoriteRoute/');
	dispatch({type: "GET_FAVORITE_ROUTES_BY_ROUTE_ID"})
};

export const getFavoriteRoutesByUserId = () => dispatch => {
	const {data} =await httpConfig('/apis/favoriteRoute/');
	dispatch({type: "GET_FAVORITE_ROUTES_BY_USER_ID"})
};