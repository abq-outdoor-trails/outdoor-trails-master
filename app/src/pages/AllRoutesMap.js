import React from "react"
import {Link} from "react-router-dom";

import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Card from "react-bootstrap/Card";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import FormControl from "react-bootstrap/es/FormControl";
import Button from "react-bootstrap/Button";

import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";

export const Navbar = () => {
	return(
		<>
			<head>
				<meta charSet="UTF-8">
					<meta name="viewport"
							content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
						<meta http-equiv="X-UA-Compatible" content="ie=edge">
							<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
									integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
									crossOrigin="anonymous">
								<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
										  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
										  crossOrigin="anonymous"></script>
								<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
										  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
										  crossOrigin="anonymous"></script>
								<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
										  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
										  crossOrigin="anonymous"></script>
								<style>
									/***
							* Flexbox Sticky Footer
							* http://philipwalton.github.io/solved-by-flexbox/demos/sticky-footer/
							***/

									/*corrects IE min-height bug*/
									html {
									display: flex;
								}

									body {
									width: 100%;
								}

									.sfooter {
									display: flex;
									flex-direction: column;
									min-height: 100vh;
								}

									.sfooter-content {
									flex: 1 0 auto;
								}
								</style>
								<title>App Layout</title>
			</head>
			<body className="sfooter">
				<div className="sfooter-content">
					<header>
						<nav className="navbar navbar-expand-lg navbar-dark bg-dark">
							<a className="navbar-brand" href="#">AbqBike</a>
							<button className="navbar-toggler" type="button" data-toggle="collapse"
									  data-target="#navbarSupportedContent"
									  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span className="navbar-toggler-icon"></span>
							</button>
							<div className="collapse navbar-collapse" id="navbarSupportedContent">
								<ul className="navbar-nav mr-auto">
									<li className="nav-item active">
										<a className="nav-link" href="#">Home <span className="sr-only">(current)</span></a>
									</li>
									<li className="nav-item">
										<a className="nav-link" href="#">Explore</a>
									</li>
									<li className="nav-item">
										<a className="nav-link" href="#">About</a>
									</li>
								</ul>
								<ul className="navbar-nav ml-lg-auto">
									<li className="nav-item dropdown dropleft">
										<a className="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
											data-toggle="dropdown"
											aria-haspopup="true" aria-expanded="false">
											Sign In
										</a>
										<div className="dropdown-menu" aria-labelledby="navbarDropdown">
											<form className="p-4">
												<div className="form-group">
													<label htmlFor="exampleInputEmail1">Email address</label>
													<input type="email" className="form-control" id="exampleInputEmail1"
															 aria-describedby="emailHelp"
															 placeholder="Enter email">
														<small id="emailHelp" className="form-text text-muted">We'll never share your email
															with anyone
															else.
														</small>
												</div>
												<div className="form-group">
													<label htmlFor="exampleInputPassword1">Password</label>
													<input type="password" className="form-control" id="exampleInputPassword1"
															 placeholder="Password">
												</div>
												<div className="form-group form-check">
													<input type="checkbox" className="form-check-input" id="exampleCheck1">
														<label className="form-check-label" htmlFor="exampleCheck1">Check me out</label>
												</div>
												<button type="submit" className="btn btn-primary">Submit</button>
											</form>
										</div>
									</li>
								</ul>
							</div>
						</nav>
					</header>
					<section>
						<div className="container">

						</div>
					</section>
					<section>
						<div className="container">

						</div>
					</section>
				</div>
				<footer className="bg-dark text-light">
					<div className="container-fluid">
						<div className="row">
							<div className="col text-center">
								<div>Icons</div>
							</div>
						</div>
					</div>
				</footer>

			</>
	)
}