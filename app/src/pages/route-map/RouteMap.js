import React, { useState } from "react"
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

const Map = ReactMapboxGl({
	accessToken: 'pk.eyJ1IjoiY2FuZGVyc29uNzMiLCJhIjoiY2p6bmEybG53MDIwbTNicHVhZHUzNmkzeiJ9.F41L6zwIg3v8CwuQyL81Pw'
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
									style="mapbox://styles/canderson73/cjznaa80x00ho1cmohdxgodas"
									containerStyle={{
										height: '50vh',
										width: '50vw'
									}}
								>
									<Layer type="symbol" id="marker" layout={{ 'icon-image': 'marker-15' }}>
										<Feature></Feature>
									</Layer>

								</Map>
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
						</Row>
					</Container>
				</section>
			</main>
		</>
	)
};
