import React from "react";
import Form from "react-bootstrap/Form";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import InputGroup from "react-bootstrap/InputGroup";
import FormControl from "react-bootstrap/es/FormControl";
import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";
import Row from "react-bootstrap/Row";
import Container from "react-bootstrap/Container";

export const Home = () => {
	return (
		<>
			<h1>Home</h1>
			<p>Welcome to ABQ Bike Trails! </p>
			<main className="d-flex align-items-end align-items-md-center mh-80">
				<Container fluid="true" className="text-center text-md-left">
					<Row>
						<div className="col-md-6 offset-md-6 col-lg-4 offset-lg-8">
							<Card bg="shadow-light" className="border-0 rounded-6">
								<Card.Body>
									<Card.Text>
										<Form>
											<Form.Group>
												<InputGroup>
													<InputGroup.Prepend>
														<InputGroup.Text>
															<FontAwesomeIcon icon="envelope"/>
														</InputGroup.Text>
													</InputGroup.Prepend>
													<FormControl type="email" placeholder="Email"/>
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
											<div className="text-md-right">
												<Button variant="primary" type="submit"> Sign In <FontAwesomeIcon icon="sign-in-alt"/>
												</Button>
											</div>
										</Form>
									</Card.Text>
								</Card.Body>
							</Card>
							<div className="my-2 text-dark">
								<span className="font-weight-dark font-italic">Don't have an account?</span>
								<Button variant="link" className="py-0 text-black border-0 font-weight-bold">Sign Up</Button>
							</div>
						</div>
					</Row>
				</Container>
			</main>

		</>
		)
};