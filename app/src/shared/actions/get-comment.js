import {httpConfig} from "../utils/http-config";
import _ from "lodash";
import {getUserbyUserId} from "./get-user";

export const getCommentsByRouteId = (id) => async dispatch => {
	const {data} = await httpConfig(`/apis/comment/?commentRouteId=${id}`);
	dispatch({type: "GET_COMMENTS_BY_ROUTE_ID", payload: data})
};

export const getCommentsAndUsersByRouteId = (id) => async  (dispatch, getState) => {
	await dispatch(getCommentsByRouteId(id));

	const userId =_.uniq(_.map(getState().comments, "commentUserId"))
	userId.forEach(id => dispatch(getUserbyUserId(id)));
};