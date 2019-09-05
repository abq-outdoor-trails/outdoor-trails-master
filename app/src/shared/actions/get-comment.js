import {httpConfig} from "../utils/http-config";
import _ from "lodash";
import {getUserbyUserId} from "./get-user";

export const getCommentsByRouteId = (id) => async dispatch => {
	const {data} = await httpConfig(`apis/comment/${id}`);
	dispatch({type: GET_COMMENTS_BY_ROUTE_ID})
};

export const getCommentsAndUsersByRouteId = (id) => async  (dispatch, getState) => {
	await dispatch(getCommentsByRouteId(id));

	const userId =_.uniq(_.map(getState().comments, "commentUserId"))
	commentId.forEach(id => dispatch(getUserbyUserId(id)));
};