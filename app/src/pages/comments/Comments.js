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
						{/*BEGIN FORM PANEL*/}
						<Col md={4} className={`posts-form-panel position-fixed ${(jwt === null && "panel-position-reset")}`}>

							{/* This nested ternary will render the PostForm only if jwt !== null,
							otherwise show signin/signup links. Then render the post form in either
							one of two different ways depending on the screen width.
							This allows the rendering of this element to be responsive. */}
							{jwt !== null ? (
								width < 768 ? (
									<Accordion defaultActiveKey="1" className="d-md-none">
										<Accordion.Toggle as={Button} variant="primary" eventKey="0" className="btn-block">
											<FontAwesomeIcon icon="pencil-alt"/>&nbsp;Write A Comment!
										</Accordion.Toggle>
										<Accordion.Collapse eventKey="0">
											<CommentForm/>
										</Accordion.Collapse>
									</Accordion>
								) : (
									<PostForm/>
								)
							) : (
								<Card bg="light" className="mb-3 text-center">
									<Card.Body>
										<h4 className="mb-3">Please log in to post a comment.</h4>
										<Link to="/" className="btn btn-outline-dark mr-3">Sign In</Link>
										<Link to="/signup" className="btn btn-dark">Sign Up</Link>
									</Card.Body>
								</Card>
							)}

						</Col>

						{/* BEGIN Comment ITEMS */}
						<Col md={{span: 8, offset: 4}} className="comments-panel">
							{comments.map(comment =>
								<CommentCard comment={comment} key={comment.commentId} />
							)}
						</Col>

					</Row>
				</Container>
			</main>
		</>
	)
};
