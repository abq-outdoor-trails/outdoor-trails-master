import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Card from "react-bootstrap/Card";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";

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

									</InputGroup>
								</Form.Group>
							</Form>
						</Card.Body>
					</Card>
				</Col>
			</Row>
		</Container>
	</main>
);

