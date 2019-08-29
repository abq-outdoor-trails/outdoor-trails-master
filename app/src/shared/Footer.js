import React from "react";

import "../index.css";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";

export const Footer = () => {
	return (
		<>
			<footer className="page-footer text-muted py-2 py-md-4">
				<Container fluid="true">
					<Row>
						<Col className="text-center">
							Github Logo Here
						</Col>
					</Row>
				</Container>
			</footer>
		</>
	)
};