import React from "react";
import Form from "react-bootstrap/Form";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import InputGroup from "react-bootstrap/InputGroup";
import FormControl from "react-bootstrap/es/FormControl";
import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import Col from "react-bootstrap/Col";
import Row from "react-bootstrap/Row";
import Container from "react-bootstrap/Container";
import Image from "react-bootstrap/Image";

import BikeImage from "../image/black-bike.jpg"
import BikeLogo from "../image/Navbar-logo-green.png"


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
								<h2>Bosque Trail</h2>
								<div id="map-wrapper">
									MapBox element goes here
								</div>
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