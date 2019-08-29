import React from "react";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Card from "react-bootstrap/Card";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import FormControl from "react-bootstrap/FormControl";

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import Spinner from "react-bootstrap/Spinner";

export const Signup = () => (
	<main className="d-flex align-items-center">
		<Container fluid="true">
			<Row>
				<Col sm={6} lg={{span: 4, offset: 1}}>
					<Card>
						<Card.Body>
							<Form>
								<Form.Group>
									<InputGroup>
										<InputGroup.Prepend>
											<InputGroup.Text>
												<FontAwesomeIcon icon="user"/>
											</InputGroup.Text>
										</InputGroup.Prepend>
										<FormControl type="text" placeholder="Pick a User Name"/>
									</InputGroup>
								</Form.Group>

								<Form.Group>
									<InputGroup>
										<InputGroup.Prepend>
											<InputGroup.Text>
												<FontAwesomeIcon icon="envelope"/>
											</InputGroup.Text>
										</InputGroup.Prepend>
										<FormControl type="email" placeholder="Your Email"/>
									</InputGroup>
								</Form.Group>

								<Form.Group>
									<InputGroup>
										<InputGroup.Prepend>
											<InputGroup.Text>
												<FontAwesomeIcon icon="key"/>
											</InputGroup.Text>
										</InputGroup.Prepend>
										<FormControl type="password" placeholder="Password"/>
									</InputGroup>
								</Form.Group>

								<Form.Group>
									<InputGroup>
										<InputGroup.Prepend>
											<InputGroup.Text>
												<FontAwesomeIcon icon="ellipsis-h"/>
											</InputGroup.Text>
										</InputGroup.Prepend>
										<FormControl type="password" placeholder="Confirm Password"/>
									</InputGroup>
								</Form.Group>
							</Form>
						</Card.Body>
					</Card>
				</Col>
			</Row>
			<Row>
				<Col>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
				</Col>
			</Row>
			<Row>
				<Col>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
				</Col>
			</Row>
			<Row>
				<Col>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
				</Col>
			</Row>
			<Row>
				<Col>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
				</Col>
			</Row>
			<Row>
				<Col>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
				</Col>
			</Row>
			<Row>
				<Col>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
				</Col>
			</Row>
			<Row>
				<Col>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
					<Spinner animation="grow" variant="success"/>
				</Col>
			</Row>
		</Container>
	</main>
);

