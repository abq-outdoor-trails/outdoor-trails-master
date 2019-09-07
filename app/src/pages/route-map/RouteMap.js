import React, {useEffect} from "react";
import {Link} from "react-router-dom";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";

import {CommentCard} from "../comments/CommentCard";
import {CommentForm} from "../comments/CommentForm";
import {useDispatch, useSelector} from "react-redux";
import {getCommentsAndUsersByRouteId} from "../../shared/actions/get-comment";
import {getRouteByRouteId} from "../../shared/actions/get-route";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import Badge from "react-bootstrap/Badge";
import Button from "react-bootstrap/Button";
import {UseJwt} from "../../shared/utils/JwtHelpers";

export const RouteMap = ({match}) => {

	const routeId =  match.params.routeId;

	const comments = useSelector(state => (state.comments ? state.comments : []));

	const route = useSelector(state => (state.route ? state.route :[]));

	const dispatch = useDispatch();

	const effects = () => {
		dispatch(getCommentsAndUsersByRouteId(routeId));
		dispatch(getRouteByRouteId(routeId));
	};

	const inputs = [routeId];

	useEffect(effects, inputs);


	return (
		<>
			<main>

				<section>
					<Container>
						<Row>
							<Col>
								<h2>Route Goes Here</h2>
								<div id="map-wrapper">
									MapBox element goes here
								</div>
							</Col>
						</Row>
					</Container>
				</section>

				<section className="py-5">
					<Container fluid="true">
						<Row>
							<Button variant="outline-green" size="sm">
								<FontAwesomeIcon icon="dagger"/>&nbsp;
								<Badge variant="dagger">2</Badge>
							</Button>
							<Col md="4">
								<div id="comment-wrapper">
									<h3>Post a Comment</h3>
									<CommentForm routeId={routeId}/>
								</div>
							</Col>

							<Col md={{span:7, offset: 1}}>
								{comments.map(comment =>
									<CommentCard comment={comment} key={comment.commentId} />
								)}
							</Col>
						</Row>
					</Container>
				</section>
			</main>
		</>
	)
};
