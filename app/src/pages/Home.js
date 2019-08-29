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

export const Home = () => {
	return (
		<>
/*******
* Hero Section
 *******/
			<main className="d-flex align-items-center align-items-md-center mh-80">
				<Container fluid="true" className="text-center text-md-center">
					<h1>Home</h1>
					<p>Welcome to ABQ Bike Trails! </p>
					<Button variant="outline-light" type="submit"> Sign Up <FontAwesomeIcon icon="sign-up"/>
					</Button>
				</Container>
			</main>

		</>
		)
};