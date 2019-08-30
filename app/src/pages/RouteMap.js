import React from "react"
import {Link} from "react-router-dom";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Card from "react-bootstrap/Card";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import FormControl from "react-bootstrap/es/FormControl";
import Button from "react-bootstrap/Button";

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import Badge from "react-bootstrap/Badge";

import ReactMapboxGl, { Layer, Feature } from 'react-mapbox-gl';
import { GeoJSONLayer} from "react-mapbox-gl/lib/geojson-layer";

const Map = ReactMapboxGl({
	accessToken: 'pk.eyJ1Ijoid2hhcnJpcyIsImEiOiJjanp3cmVkdHMwMnkzM2JwbThiYXd3YWJtIn0.LYO1SzQdH7Q8p1as8N3dMA'
});

export const RouteMap = () => {
	return (
		<>
			<main>

				<section>
				<Container>
					<Row>
						<Col>
							<h2>Bosque Trail</h2>
							<Map
									style="mapbox://styles/mapbox/streets-v9"
									containerStyle={{
										height: '100vh',
										width: '100vw'
									}}
								>
									<Layer type="symbol" id="marker" layout={{ 'icon-image': 'marker-15' }}>
										<Feature coordinates={[-106.6505556, 35.0844444]}/>
									</Layer>
								</Map>
						</Col>
					</Row>
				</Container>
			</section>

				<section className="py-md-4">
					<Container fluid="true">
						<Row>
							<Col md="4">
								<div id="comment-wrapper">
									<h3>Post a Comment</h3>
									<Form>
										<Form.Group controlId="exampleForm.ControlTextarea1">
											<Form.Label className="sr-only">Comment Area</Form.Label>
											<Form.Control as="textarea" rows="3" />
											<Button variant="success">Submit</Button>
										</Form.Group>
									</Form>
								</div>
							</Col>
							<Col md={{span:7, offset: 1}}>
								<Card className="mb-3">
									<Card.Body>
										<div className="d-flex justify-content-end">
											<div className="d-inline-block small text-muted mr-auto my-auto">Author | Datetime</div>
											<Button variant="outline-secondary" size="sm" className="mr-2">
												<FontAwesomeIcon icon="trash"/>
											</Button>
											<Button variant="outline-secondary" size="sm" className="mr-2">
												<FontAwesomeIcon icon="pencil-alt"/>
											</Button>
											<Button variant="outline-danger" size="sm">
												<FontAwesomeIcon icon="heart"/>&nbsp;
												<Badge variant="danger">94</Badge>
											</Button>
										</div>
										<hr />
										<Card.Text>Content Here</Card.Text>
									</Card.Body>
								</Card>
							</Col>
							<Col md={{span:4, offset: 0}}>
								<Button variant="success">Favorite</Button>
							</Col>
						</Row>
					</Container>
				</section>
			</main>
		</>
	)
};
