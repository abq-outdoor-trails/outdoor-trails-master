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
import ButtonToolbar from "react-bootstrap/ButtonToolbar"

import BikeImage from "../../image/black-bike.jpg"
import BikeLogo from "../../image/Navbar-logo-green.png"
import TeamPhoto from "../../image/bike-team.jpg"

import ReactMapboxGl, {Layer, Feature, MapContext} from 'react-mapbox-gl';
import {ZoomControl} from "react-mapbox-gl";
import CardDeck from "react-bootstrap/CardDeck";

const Map= ReactMapboxGl({
	accessToken: 'pk.eyJ1IjoiY2FuZGVyc29uNzMiLCJhIjoiY2p6bmEybG53MDIwbTNicHVhZHUzNmkzeiJ9.F41L6zwIg3v8CwuQyL81Pw'
});


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
							<Col xs={8}>
								<h2>Trails</h2>
								<div id="map-wrapper">
									<Map
										style="mapbox://styles/canderson73/cjznaa80x00ho1cmohdxgodas"
										containerStyle={{
											height: '60vmax',
											width: '80vmax'
										}}
										center= {[-106.6505556, 35.0844444]}
										zoom={[11]}
										>
										<ZoomControl/>
										<Layer type="symbol" id="marker" layout={{ 'icon-image': 'marker-15' }}>
											<Feature>
											</Feature>
										</Layer>

									</Map>
								</div>
							</Col>
							<Col>

							</Col>
						</Row>
					</Container>

				{/*	<Container fluid="true">*/}
				{/*		<Row>*/}
				{/*			<CardDeck>*/}
				{/*			<Col m={2}>*/}
				{/*				<Card bg="light" className="mb-3">*/}
				{/*					<Card.Header>Unser Trail N</Card.Header>*/}
				{/*					<Card.Body>*/}
				{/*						<Button variant="primary" ><a style={{color:"white"}} href="http://localhost:3000/route/1b1576cf-4140-467f-b9d4-3dbb0dc0755d">View Route</a></Button>*/}
				{/*					</Card.Body>*/}
				{/*				</Card>*/}
				{/*			</Col>*/}
				{/*			<Col m={2}>*/}
				{/*				<Card bg="light" className="mb-3">*/}
				{/*					<Card.Header>Bear Canyon Arroyo</Card.Header>*/}
				{/*					<Card.Body>*/}
				{/*						<Button variant="primary"><a style={{color: "white"}} href="http://localhost:3000/route/1f4a61d4-de96-4e9b-a627-e5b073d2b458">View Route</a></Button>*/}
				{/*					</Card.Body>*/}
				{/*				</Card>*/}
				{/*			</Col>*/}
				{/*			<Col m={2}>*/}
				{/*				<Card bg="light" className="mb-3">*/}
				{/*					<Card.Header>Paseo del Bosque</Card.Header>*/}
				{/*					<Card.Body>*/}
				{/*						<Button variant="primary"><a style={{color:"white"}} href="http://localhost:3000/route/d273c505-1f0b-42ea-8990-de4371e05070">View Route</a></Button>*/}
				{/*					</Card.Body>*/}
				{/*				</Card>*/}
				{/*			</Col>*/}
				{/*			<Col m={2}>*/}
				{/*				<Card bg="light" className="mb-3">*/}
				{/*					<Card.Header>Sandia Science and Technology Trail</Card.Header>*/}
				{/*					<Card.Body>*/}
				{/*						<Button variant="primary"><a style={{color:"white"}} href="http://localhost:3000/route/8183567a-5114-45c9-9525-2b56962e3658">View Route</a></Button>*/}
				{/*					</Card.Body>*/}
				{/*				</Card>*/}
				{/*			</Col>*/}
				{/*			<Col m={2}>*/}
				{/*				<Card bg="light" className="mb-3">*/}
				{/*					<Card.Header>Paseo del Norte Trail</Card.Header>*/}
				{/*					<Card.Body>*/}
				{/*						<Button variant="primary"><a style={{color:"white"}} href="http://localhost:3000/route/898dda16-ffeb-4483-93c3-60dc1050cf89">View Route</a></Button>*/}
				{/*					</Card.Body>*/}
				{/*				</Card>*/}
				{/*			</Col>*/}
				{/*			<Col m={2}>*/}
				{/*				<Card bg="light" className="mb-3">*/}
				{/*					<Card.Header>North Diversion Channel</Card.Header>*/}
				{/*					<Card.Body>*/}
				{/*						<Button variant="primary"><a style={{color:"white"}} href="http://localhost:3000/route/a3403289-20f6-43cf-943f-fe228450b977">View Route</a></Button>*/}
				{/*					</Card.Body>*/}
				{/*				</Card>*/}
				{/*			</Col>*/}
				{/*			</CardDeck>*/}
				{/*		</Row>*/}
				{/*	</Container>*/}
				{/*</section>*/}
				{/*About Section*/}
					{/*begin trail cards section*/}
				<section class="py-5">
					<div class="container-fluid">
						<div class="row">

							<div class="col-xl-2 col-md-3 col-sm-6 mb-2">
								<div class="d-flex flex-column border text-center p-3 h-100">
									<h4 class="flex-grow-1 mb-4">Unser Trail North</h4>
									<a href="http://localhost:3000/route/1b1576cf-4140-467f-b9d4-3dbb0dc0755d" class="btn btn-primary">View Route</a>
								</div>
							</div>

							<div className="col-xl-2 col-md-3 col-sm-6 mb-2">
								<div className="d-flex flex-column border text-center p-3 h-100">
									<h4 className="flex-grow-1 mb-4">Bear Canyon Arroyo</h4>
									<a href="http://localhost:3000/route/1f4a61d4-de96-4e9b-a627-e5b073d2b458" className="btn btn-primary">View Route</a>
								</div>
							</div>

							<div className="col-xl-2 col-md-3 col-sm-6 mb-2">
								<div className="d-flex flex-column border text-center p-3 h-100">
									<h4 className="flex-grow-1 mb-4">Paseo del Bosque</h4>
									<a href="http://localhost:3000/route/d273c505-1f0b-42ea-8990-de4371e05070" className="btn btn-primary">View Route</a>
								</div>
							</div>

							<div className="col-xl-2 col-md-3 col-sm-6 mb-2">
								<div className="d-flex flex-column border text-center p-3 h-100">
									<h4 className="flex-grow-1 mb-4">Sandia Science and Technology Trail</h4>
									<a href="http://localhost:3000/route/8183567a-5114-45c9-9525-2b56962e3658" className="btn btn-primary">View Route</a>
								</div>
							</div>

							<div className="col-xl-2 col-md-3 col-sm-6 mb-2">
								<div className="d-flex flex-column border text-center p-3 h-100">
									<h4 className="flex-grow-1 mb-4">Paseo del Norte Trail</h4>
									<a href="http://localhost:3000/route/898dda16-ffeb-4483-93c3-60dc1050cf89" className="btn btn-primary">View Route</a>
								</div>
							</div>

							<div className="col-xl-2 col-md-3 col-sm-6 mb-2">
								<div className="d-flex flex-column border text-center p-3 h-100">
									<h4 className="flex-grow-1 mb-4">North Diversion Channel</h4>
									<a href="http://localhost:3000/route/a3403289-20f6-43cf-943f-fe228450b977" className="btn btn-primary">View Route</a>
								</div>
							</div>
						</div>
					</div>
				</section>

				<section id="about">
					<div id="container-fluid">
						<Container>
							<h3>The ABQ Bike Trails Team 2019</h3>
							<Row>
								<Col>
									<div id="about-wrapper">
										{<Image src={TeamPhoto} fluid alt="Abq Bike Team Photo"/>}
									</div>
								</Col>
							</Row>
						</Container>
					</div>
				</section>
					<section>
						<Container>
							<CardGroup>
								<Card>
									{/*<Card.Img variant="top" src="holder.js/100px160"/>*/}
									<Card.Body>
										<Card.Title className="text-center"><h2>Chrystal Copeland</h2></Card.Title>
										<Card.Text>
											Front End Lead and Technical Assist - former massage therapist turned developer. New
											Mexico native
											relocating to the big city of Denver. Will smuggle green chile for code.
										</Card.Text>
									</Card.Body>
									<Card.Footer className="text-center">
										<FontAwesomeIcon icon={['fab', 'linkedin']} /> &nbsp;
										<a target="_blank" href="https://www.linkedin.com/in/copelandchrystal" className="text-muted">LinkedIn</a>
									</Card.Footer>
								</Card>
								<Card>
									{/*<Card.Img variant="top" src="holder.js/100px160"/>*/}
									<Card.Body>
										<Card.Title className="text-center"><h2>John Dunn</h2></Card.Title>
										<Card.Text>
											Project Management Lead and Dev Assist - former Verizon IT guru searching for the
											meaning of life in web development. Knows almost every single person in Albuquerque.
										</Card.Text>
									</Card.Body>
									<Card.Footer className="text-center">
										<FontAwesomeIcon icon={['fab', 'linkedin']} /> &nbsp;
										<a target="_blank" href="https://www.linkedin.com/in/john-william-dunn" className="text-muted">LinkedIn</a>
									</Card.Footer>
								</Card>
								<Card>
									{/*<Card.Img variant="top" src="holder.js/100px160"/>*/}
									<Card.Body>
										<Card.Title className="text-center"><h2>Will Harris</h2></Card.Title>
										<Card.Text>
											Technical Lead - Santa Fe resident and avid bicyclist. Has aspirations of being the
											best programmer he can be! Eats avocado toast every day for breakfast.
										</Card.Text>
									</Card.Body>
									<Card.Footer className="text-center">
										<FontAwesomeIcon icon={['fab', 'linkedin']} /> &nbsp;
										<a target="_blank" href="https://www.linkedin.com/in/will-t-harris/" className="text-muted">LinkedIn</a>
									</Card.Footer>
								</Card>
							</CardGroup>
						</Container>
					</section>
				</section>
			</main>
		</>
	)
};