import React from 'react';
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";

export const NavBar = () => {
	return (
		<>
			<Navbar bg="dark" variant="dark">
				<Navbar.Brand href="#home">
					AbqBike
				</Navbar.Brand>
				<Nav.Link href="#sign-in" className="ml-auto">Sign In</Nav.Link>
				<Nav.Link href="#sign-up">Sign Up</Nav.Link>
			</Navbar>
		</>
	)
};