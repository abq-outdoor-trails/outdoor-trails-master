import React from 'react';
import {SignInForm} from "./SignInForm";


import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import NavDropdown from "react-bootstrap/NavDropdown";
import NavbarBrand from '../../../image/bike-abq-5-small.png'
import BikeLogo from "../../../image/Navbar-logo-green.png"

import Button from "react-bootstrap/Button";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {httpConfig} from "../../utils/http-config";
import {Link} from "react-router-dom";
import {UseJwt, UseJwtUserId, UseJwtUsername} from "../../utils/JwtHelpers";


export const Header = (props) => {

	// grab the jwt and username for logged in users
	const jwt = UseJwt();
	const userName = UseJwtUsername();
	const userId = UseJwtUserId();

	const signOut = () => {
		httpConfig.get("/apis/signout/")
			.then(reply => {
				let {message, type} = reply;
				if(reply.status === 200) {
					window.localStorage.removeItem("jwt-token");
					setTimeout(() => {
						window.location = "/";
					}, 1500);
				}
			});
	};



	return (
		<>
			<Navbar bg="dark" variant="dark" className="navbar-styles" expand="lg">
				<Navbar.Brand href="/#home">
					<img className="nav-logo"
						  src={BikeLogo}
						  width="200"
						  height="60"
						  className="d-inline-block align-top"
					/>
				</Navbar.Brand>
				<Navbar.Toggle aria-controls="basic-navbar-nav"/>
				<Navbar.Collapse id="basic-navbar-nav">
					<Nav className="mr-auto">
						<Nav.Link href="/#route">Routes</Nav.Link>
						<Nav.Link href="/#about">About</Nav.Link>
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