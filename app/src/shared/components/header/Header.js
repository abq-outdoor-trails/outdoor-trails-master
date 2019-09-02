import React from 'react';
import {SignInForm} from "./SignInForm";


import '../../../index.css';

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
			<Navbar bg="dark" variant="dark" className="navbar-styles" expand="lg">
				<Navbar.Brand href="#home" className="brand-styles">AbqBike</Navbar.Brand>
				<Navbar.Toggle aria-controls="basic-navbar-nav" />
				<Navbar.Collapse id="basic-navbar-nav">
					<Nav className="mr-auto">
						<Nav.Link href="#route">Routes</Nav.Link>
						<Nav.Link href="#about">About</Nav.Link>
						<NavDropdown title="Sign In" id="collapsible-nav-dropdown">
							<SignInForm>
							</SignInForm>
						</NavDropdown>
					</Nav>
				</Navbar.Collapse>
			</Navbar>
		</>
	)
};