import React from "react";
import {SignUpForm} from "./SignUpForm";


import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Card from "react-bootstrap/Card";
import Spinner from "react-bootstrap/Spinner";

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

export const Signup = () => (
	<main className="d-flex align-items-center">
		<Container fluid="true">
			<Row>
				<Col sm={6} lg={{span: 4, offset: 1}}>
					<Card>
						<Card.Body>
							<SignUpForm id="collapsible-nav-dropdown"/>
						</Card.Body>
					</Card>
				</Col>
			</Row>
		</Container>
	</main>
);