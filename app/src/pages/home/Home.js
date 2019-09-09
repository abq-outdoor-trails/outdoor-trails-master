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
import CardGroup from "react-bootstrap/CardGroup";

import BikeImage from "../../image/black-bike.jpg"
import BikeLogo from "../../image/Navbar-logo-green.png"
import TeamPhoto from "../../image/bike-team.jpg"


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
									<Card.Title><h2>Will Harris</h2></Card.Title>
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
									<Card.Title><h2>Chrystal Copeland</h2></Card.Title>
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
									<Card.Title><h2>John Dunn</h2></Card.Title>
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