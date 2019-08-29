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

export const RouteMap = () => {
	return (
		<>
			<main className="d-flex align-items-center mh-80">

				<Container fluid="true">
					<Row>
						<Col>
							<h2>Bosque Trail</h2>
							<div id="map-wrapper">
								MapBox element goes here
							</div>
						</Col>
					</Row>
				</Container>
			</main>
			<Container fluid="true">
				<Row>
					<Col>
						<h1>Comment Area</h1>
						<div id="comment-wrapper">
							Comment element goes here
						</div>
					</Col>
				</Row>
			</Container>
			<Container>
				<Row>
					<Col>
						<Card bg="transparent" className="border-0 rounded-0">
							<Card.Body>
								<Form>

									<Form.Group>
										<InputGroup>
											<InputGroup.Prepend>
												<InputGroup.Text>
													<FontAwesomeIcon icon="envelope"/>
												</InputGroup.Text>
											</InputGroup.Prepend>
											<FormControl type="Date" placeholder={"Date"}/>
										</InputGroup>
									</Form.Group>
								</Form>
							</Card.Body>
						</Card>
					</Col>
				</Row>
			</Container>
		</>
	)
};
