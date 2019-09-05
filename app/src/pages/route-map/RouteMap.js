import React, {useEffect} from "react";
import {Link} from "react-router-dom";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";

import {CommentCard} from "../comments/CommentCard";
import {CommentForm} from "../comments/CommentForm";
import {useDispatch, useSelector} from "react-redux";
import {getCommentsByRouteId} from "../../shared/actions/get-comment";
import {getRouteByRouteId} from "../../shared/actions/get-route";

export const RouteMap = ({match}) => {

	const routeId =  match.params.routeId;

	const comments = useSelector(state => (state.comment ? state.comment : []));

	const route = useSelector(state => (state.route ? state.route :[]));
	console.log(comments, route);
	const dispatch = useDispatch();

	const effects = () => {
		dispatch(getCommentsByRouteId(routeId));
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
								<h2>Bosque Trail</h2>
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

							<Col md="4">
								<div id="comment-wrapper">
									<h3>Post a Comment</h3>
									<CommentForm/>
								</div>
							</Col>

							<Col md={{span:7, offset: 1}}>
								<CommentCard/>
							</Col>
						</Row>
					</Container>
				</section>
			</main>
		</>
	)
};
