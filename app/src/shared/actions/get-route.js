import {httpConfig} from "../utils/http-config";

export const getRouteByRouteId = () => async dispatch => {
	const {data} = await httpConfig('/apis/route/');
	dispatch({type: "GET_ROUTE_BY_ROUTE_ID", payload:data})
};

export const getRouteByRouteType = () => async dispatch => {
	const {data} = await httpConfig('/apis/route/');
	dispatch({type: "GET_ROUTE_BY_ROUTE_TYPE", payload:data})
};

export const getRouteByRouteName = () => async dispatch => {
	const {data} = await httpConfig('/apis/route/');
	dispatch({type: "GET_ROUTE_BY_ROUTE_NAME", payload:data})
};

