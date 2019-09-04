import {httpConfig} from "../utils/http-config";
import _ from "lodash";
import {getUserbyUserId} from "./get-user";

export const getCommentByCommentId = () => async dispatch => {
	const {data} = await httpConfig('apis/comment');
	dispatch({type: "GET_COMMENT_BY_COMMENT_ID"})
};

export const getCommentsByRouteId = () => async  (dispatch, getState) => {
	await dispatch(getCommentByCommentId());

	const userId =_.uniq(_.map(getState().comments, "commentUserId"))
	commentId.forEach(id => dispatch(getUserbyUserId(id)));
};