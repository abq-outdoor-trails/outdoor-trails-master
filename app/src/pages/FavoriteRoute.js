import React, {useEffect} from "react";
import {useSelector} from "react-redux";
import {httpConfig} from "..shared/misc/http-config";
import {UseJwt} from "../shared/misc/JwtHelpers";
import {handleSessionTimeout} from "../shared/utils/handle-session-timeout";
import _ from "lodash";

import Badge from "react-bootstrap/Badge";
import Button from "react-bootstrap/Button";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

export const favoriteRoute = ({userId, commentId}) => {
	// grab the jwt for logged in users
	const jwt = UseJwt();

	/*
	* the isCommented state variable sets the button color whether or not the logged in user
	* has liked the comment.
	*
	* the FavoriteRouteCount state variable counts favoriteRoutes
	 */

	const [isFavoriteRoute, setIsFavoriteRoute] = useState(null);
	const [favoriteRouteCount, setFavoriteRouteCount] = useState(0);

	//return all favoriteRoutes from the redux store
	const favoriteRoute = useSelector(state => (state.favoriteRoutes ? state.favoriteRoutes : []));

	const effects = () => {
		initializeFavoriteRoute(userId);
		countFavoriteRoute();
	};

	const inputs = [commentId];
	useEffect(effects, inputs);

	/**
	 * this function filters over the favorite routes from the store,
	 * and sets the isFavoriteRoute state variable to "active" if
	 * the logged in user has favorited the route.
	 *
	 * This makes the button red.
	 *
	 * See: lodash https:lodash.com
	 * */
	const initializeFavoriteRoute = (userId) => {
		const userFavoriteRoutes = favoriteRoute.filter(favoriteRoute => favoriteRoute.favoriteRouteCommentId === commentId);
		return (setFavoriteRouteCount(favoriteRoute.length));
	};

	const data = {
		favoriteRouteCommentId: commentId,
		favoriteRouteUserId: userId
	};

	const toggleFavoriteRoute = () => {
		setIsFavoriteRoute(isFavoriteRoute === null ? "active" : null);
	};

	const submitFavoriteRoute = () => {
		const headers = {'X-JWT-TOKEN': jwt};
		httpConfig.comments("/apis/FavoriteRoute", data, {
			headers: headers
		})
			.then(reply => {
				let {message, type} = reply
				{
					toggleFavoriteRoute();
					setFavoriteRouteCount(favoriteRouteCount + 1);
				}
				// if there is an issue with a $_SESSION mismatch with xsrf or jwt, alert user and do a sign out
				if(reply.status === 401) {
					handleSessionTimeout();
				}
			});
	};

	const deleteFavoriteRoute = () => {
		httpConfig.delete("/apis/like/", {
			headers, data
		})
			.then(reply => {
				let {message, type} = reply;
				if(reply.status === 200) {
					toggleFavoriteRoute();
					setFavoriteRouteCount(favoriteRouteCount > 0 ? favoriteRouteCount - 1 : 0);
				}
				// if there is an error with a $_SESSION mismatch with xsrf or jwt, alert user and do a sign out
				if(reply.status === 401) {
					handleSessionTimeout();
				}
			});
	};

	//fire this function on click
	const clickFavoriteRoute = () => {
		(isFavoriteRoute === "active") ? deleteFavoriteRoute() : submitFavoriteRoute();
	};
	return (
		<>
			<Button variant="outline-danger" size="sm"
					  className={'comment-favoriteRoute-btn ${(isFavoriteRoute !==null ? isFavoriteRoute: "")}'}
					  onClick={clickFavoriteRoute}>
				<FontAwesomeIcon icon="heart"/>&nbsp;
				<Badge variant="danger">{favoriteRouteCount}</Badge>
			</Button>
		</>
	)
};