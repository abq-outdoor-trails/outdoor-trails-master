import {httpConfig} from "../utils/http-config";


export const getUserbyUserId = (id) => async dispatch => {
	const {data} = await httpConfig('/apis/user/${id}');
	dispatch({type: "GET_USER_BY_USER_ID", payload: data})
};

export const getUserbyUserEmail = (email) => async dispatch => {
	const {data} = await httpConfig('/apis/user/?userEmail=${email}');
	dispatch({type: "GET_USER_BY_USER_EMAIL", payload: data})
};