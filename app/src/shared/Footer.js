import React from "react";
import "../index.css";
import Navbar from "react-bootstrap/Navbar";

export const Footer = () => {
	return (
		<>
			<Navbar bg="dark" variant="dark" className="footer-styles">
				<Navbar.Brand href="#home" className="brand-styles">AbqBike</Navbar.Brand>
			</Navbar>
		</>
	)
};