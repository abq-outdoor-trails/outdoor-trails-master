import React, {useEffect, useState} from "react";
import _ from 'lodash';
import {HomeMap} from "../../shared/components/home-map/HomeMap";

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import Button from "react-bootstrap/Button";
import Col from "react-bootstrap/Col";
import Row from "react-bootstrap/Row";
import Container from "react-bootstrap/Container";
import Image from "react-bootstrap/Image";
import CardGroup from "react-bootstrap/CardGroup";
import Card from "react-bootstrap/Card";

import BikeImage from "../../image/black-bike.jpg";
import BikeLogo from "../../image/Navbar-logo-green.png";
import {RouteMap} from "../route-map/RouteMap";
import {useDispatch, useSelector} from "react-redux";
import {getRouteByRouteType} from "../../shared/actions/get-route";
import TeamPhoto from "../../image/bike-team.jpg";
import {Feature} from "react-mapbox-gl";

export const Home = () => {

	const [routeType, setRouteType] = useState('Paved Multiple Use Trail - A paved trail closed to automotive traffic.');

	// returns the routes store from redux and assign it to the routes variable
	const routes = useSelector(state => state.route ? state.route : []);
	const flattedIt = _.flatten(routes);

	console.log(JSON.parse(flattedIt));

	// assigns useDispatch reference to the dispatch variable for later use
	const dispatch = useDispatch();

	const effects = () => {
		dispatch(getRouteByRouteType(routeType));
	};

	const inputs = [routeType];

	useEffect(effects, inputs);

	return (
		<>
			<main className="mh-80">

				{/*Hero Section*/}
				<section className="home-hero">
					<Container fluid="true" className="text-center">
						<Row>
							<Col>
								{<Image src={BikeLogo} fluid alt="ABQ Bike Logo"/>}
								<h1 className="display-3 font-weight-light">Welcome to ABQ Bike Trails</h1>
								<Button
									href="../Signup"
									variant="outline-light" size="lg" type="submit"> Sign Up <FontAwesomeIcon icon="sign-up"/>
								</Button>

							</Col>
						</Row>
					</Container>
				</section>

				{/*Map Section*/}
				<section id="route">
					<Container>
						<Row>
							<Col>
								<HomeMap>
									{/*{flattedIt.map(line => console.log(JSON.parse(line.routeFile)))}*/}
								</HomeMap>
							</Col>
						</Row>
					</Container>
				</section>

				{/*About Section*/}
				<section id="about">
					<Container>
						<Row>
							<Col>
								<h2>This is our About Section</h2>
								{<Image src={TeamPhoto} fluid alt="Abq Bike Team Photo"/>}
							</Col>
						</Row>
					</Container>
				</section>
				<section>
					<Container>
						<CardGroup>
							<Card>
								<Card.Img variant="top" src="holder.js/100px160" />
								<Card.Body>
									<Card.Title>Will Harris</Card.Title>
									<Card.Text>
										This is a wider card with supporting text below as a natural lead-in to
										additional content. This content is a little bit longer.
									</Card.Text>
								</Card.Body>
								<Card.Footer>
									<small className="text-muted">LinkedIn</small>
								</Card.Footer>
							</Card>
							<Card>
								<Card.Img variant="top" src="holder.js/100px160" />
								<Card.Body>
									<Card.Title>Chrystal Copeland</Card.Title>
									<Card.Text>
										This card has supporting text below as a natural lead-in to additional
										content.{' '}
									</Card.Text>
								</Card.Body>
								<Card.Footer>
									<small className="text-muted">LinkedIn</small>
								</Card.Footer>
							</Card>
							<Card>
								<Card.Img variant="top" src="holder.js/100px160" />
								<Card.Body>
									<Card.Title>John Dunn</Card.Title>
									<Card.Text>
										This is a wider card with supporting text below as a natural lead-in to
										additional content. This card has even longer content than the first to
										show that equal height action.
									</Card.Text>
								</Card.Body>
								<Card.Footer>
									<small className="text-muted">LinkedIn</small>
								</Card.Footer>
							</Card>
						</CardGroup>
					</Container>
				</section>

			</main>

		</>
	)
};