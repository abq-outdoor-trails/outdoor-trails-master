import React from 'react';

import '../index.css';

import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import NavDropdown from "react-bootstrap/NavDropdown";
import Form from "react-bootstrap/Form";
import FormControl from "react-bootstrap/FormControl";
import Button from "react-bootstrap/Button";
import InputGroup from "react-bootstrap/InputGroup";

export const Header = () => {
	return (
		<>
			<Navbar bg="dark" variant="dark" className="navbar-styles">
				<Navbar.Brand href="#home" className="brand-styles">AbqBike</Navbar.Brand>
				<Navbar.Toggle aria-controls="basic-navbar-nav" />
				<Navbar.Collapse id="basic-navbar-nav">
					<Nav className="mr-auto">
						<Nav.Link href="#route">Routes</Nav.Link>
						<Nav.Link href="#about">About</Nav.Link>
						<Nav.Link href="#signup">Sign Up</Nav.Link>
					</Nav>
					<Form inline>
						<InputGroup>
							<FormControl
								placeholder="Email"
								aria-label="Email"
								aria-describedby=""
							/>
							<FormControl
								placeholder="Password"
								aria-label="Password"
								aria-describedby=""
							/>
						</InputGroup>
						<Button type="submit">Sign In</Button>
					</Form>
				</Navbar.Collapse>
				<Nav.Link href="#sign-in" className="ml-auto navbar-styles">Sign In</Nav.Link>
			</Navbar>
		</>
	)
};