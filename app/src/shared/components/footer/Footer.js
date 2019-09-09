import React from "react";

import {Link} from "react-router-dom";

import "../../../index.css";

import Col from "react-bootstrap/Col";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";


export const Footer = () => (
	<>
		<footer className="page-footer text-muted py-2 py-md-4">
			<Container fluid="true">
				<Row>
					<Col className="text-center">
						<FontAwesomeIcon icon={['fab', 'github']} /> &nbsp;
						<a href="https://github.com/abq-outdoor-trails/outdoor-trails-master" className="text-muted" target="_blank" rel="noopener noreferrer">GitHub</a> | <Link className="text-muted" to="/about">About Us</Link>
					</Col>
				</Row>
			</Container>
		</footer>
	</>
);