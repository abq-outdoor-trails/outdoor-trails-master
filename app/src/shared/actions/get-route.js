import {httpConfig} from "../utils/http-config";

export const getRouteByRouteId = (id) => async dispatch => {
	const {data} = await httpConfig(`/apis/route/${id}`);
	dispatch({type: "GET_ROUTE_BY_ROUTE_ID", payload:data})
};

export const getRouteByRouteType = (routeType) => async dispatch => {
	const {data} = await httpConfig(`/apis/route/?routeType=${routeType}`);
	dispatch({type: "GET_ROUTE_BY_ROUTE_TYPE", payload:data})
};

export const getRouteByRouteName = (name) => async dispatch => {
	const {data} = await httpConfig(`/apis/route/${name}`);
	dispatch({type: "GET_ROUTE_BY_ROUTE_NAME", payload:data})
};

