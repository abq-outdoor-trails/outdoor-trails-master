import React, {useEffect} from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import Button from "react-bootstrap/Button";
import Col from "react-bootstrap/Col";
import Row from "react-bootstrap/Row";
import Container from "react-bootstrap/Container";
import Image from "react-bootstrap/Image";

import BikeImage from "../../image/black-bike.jpg";
import BikeLogo from "../../image/Navbar-logo-green.png";
import {RouteMap} from "../route-map/RouteMap";
import {useDispatch, useSelector} from "react-redux";
import {getRouteByRouteType} from "../../shared/actions/get-route";


export const Home = ({match}) => {

	const routeType = match.params.routeType;

	// returns the routes store from redux and assign it to the routes variable
	const routes = useSelector(state => state.route ? state.route : []);

	// assigns useDispatch reference to the dispatch variable for later use
	const dispatch = useDispatch();

	const effects = () => {
		dispatch(getRouteByRouteType());
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
				<section>
					<Container>
						<Row>
							<Col>
								<RouteMap />
							</Col>
						</Row>
					</Container>
				</section>

				{/*About Section*/}
				<section>
					<Container>
						<Row>
							<Col>
								<h1>This is our About Section</h1>
								{<Image src={BikeImage} fluid alt="Yellow Bike"/>}
							</Col>
						</Row>
					</Container>
				</section>

			</main>

		</>
	)
};