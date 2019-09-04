import React, {useEffect} from "react";
import {Link} from "react-router-dom";
import {useSelector, useDispatch} from "react-redux";

import {PostForm} from "./CommentForm";
import {PostCard} from "./CommentCard";

import {UseJwt, UseJwtProfileId, UseJwtUsername} from "../../shared/utils/JwtHelpers";
import {getAllLikes} from "../../shared/actions/get-like";
import {getPostsAndProfiles} from "../../shared/actions/get-post";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Card from "react-bootstrap/Card";
import Button from "react-bootstrap/Button";
import Accordion from "react-bootstrap/Accordion";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

export const Comments = () => {

	//grab jwt for logged in users
	const jwt = UseJwt();
	const userId = useJwtUserId();

	//Returns the posts store from redux and assigns it to the posts variable.
	const comments = useSelector(state => (state.comments ? state.comments : []));

	//assigns useDispatch reference to the dispatch variable for later use.
	const dispatch = useDispatch();

	//Define the side effects that will occur in the application e.g., code that handles dispatches to redux, API's. or timers.
	//The dispatch function takes actions as arguments to make changes to the store/redux.
	const effects = () => {
		dispatch(getCommentsAndUsers());
		dispatch(getAllFavorites());
	};

	//Declare any inputs that will be used by functions that are declared in sideEffects.
	const inputs = [userId];

	/**
	 *
	 * Pass both sideEffects and sideEffectInputs to useEffect.
	 * useEffect is what handles the re-rendering of components when sideEffects resolve.
	 * e.g. when a network request to an api has completed and there is new data to display to the dom.
	 **/
	useEffect(effects, inputs);

	return (
		<>
			<main className="my-5">
				<Container fluid="true" className="py-5">
					<Row>


					</Row>
	)
}
