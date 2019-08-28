import React from 'react';
import '../index.css';
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";

export const NavBar = () => {
	return (
		<>
			<Navbar bg="dark" variant="dark" className="navbar-styles">
				<Navbar.Brand href="#home" className="brand-styles">
					AbqBike
				</Navbar.Brand>
				<Nav.Link href="#sign-in" className="ml-auto navbar-styles">Sign In</Nav.Link>
				<Nav.Link href="#sign-up" className="navbar-styles">Sign Up</Nav.Link>
			</Navbar>
		</>
	)
};