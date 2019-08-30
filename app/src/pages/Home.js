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

import BikeImage from "../image/yellow-bike.jpg"


export const Home = () => {
	return (
		<>

			<main className="mh-80">

				{/*Hero Section*/}
				<section className="home-hero">
					<Container fluid="true" className="text-center">
						<Row>
							<Col>
								<h1 class="display-3 font-weight-bold">Welcome to ABQ Bike Trails</h1>
								<p> </p>
								<Button
									variant="outline-light" type="submit"> Sign Up <FontAwesomeIcon icon="sign-up"/>
								</Button>
								{/*<Image src={BikeImage} fluid alt="Yellow Bike"/>*/}
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