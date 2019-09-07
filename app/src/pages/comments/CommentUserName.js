import React from 'react';
import {useSelector} from "react-redux";

export const CommentUserName = ({userId}) => {

	const user = useSelector((state)=> {

		return state.user ? state.user.find( user => userId === user.userId) : null
	});

		return  (
			<>
				{user ? user.userName : "???"}

			</>
		);
};