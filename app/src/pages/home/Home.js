import React from "react";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import Button from "react-bootstrap/Button";
import Col from "react-bootstrap/Col";
import Row from "react-bootstrap/Row";
import Container from "react-bootstrap/Container";
import Image from "react-bootstrap/Image";

import BikeImage from "../../image/black-bike.jpg"
import BikeLogo from "../../image/Navbar-logo-green.png"
import {RouteMap} from "../route-map/RouteMap";


export const Home = () => {
	return (
		<>

			<main className="mh-80">

				{/*Hero Section*/}
				<section className="home-hero">
					<Container fluid="true" className="text-center">
						<Row>
							<Col>
								{<Image src={BikeLogo} fluid alt="ABQ Bike Logo"/>}
								<h1 class="display-3 font-weight-light">Welcome to ABQ Bike Trails</h1>
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