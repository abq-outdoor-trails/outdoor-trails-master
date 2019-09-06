import {httpConfig} from "../utils/http-config";


export const getFavoriteRoutesByRouteId = (id) => async dispatch => {
	const {data} =await httpConfig(`/apis/favoriteRoute/${id}`);
	dispatch({type: "GET_FAVORITE_ROUTES_BY_ROUTE_ID", payload:data})
};
