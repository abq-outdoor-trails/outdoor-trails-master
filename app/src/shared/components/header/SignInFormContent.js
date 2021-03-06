import React from "react";
import {Link} from "react-router-dom";


import {FormDebugger} from "../../components/FormDebugger";

import Card from "react-bootstrap/Card";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import FormControl from "react-bootstrap/es/FormControl";
import Button from "react-bootstrap/Button";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {AxiosInstance as httpConfig} from "axios";



export const SignInFormContent = (props) => {
	const {
		status,
		values,
		errors,
		touched,
		dirty,
		isSubmitting,
		handleChange,
		handleBlur,
		handleSubmit,
		handleReset
	} = props;
	
	return (
		<>
			<Card bg="transparent" className="border-0 rounded-0">
				<Card.Body>
					<Form onSubmit={handleSubmit}>
						<Form.Group>
							<Form.Label className="sr-only">Email</Form.Label>
							<InputGroup>
								<InputGroup.Prepend>
									<InputGroup.Text>
										<FontAwesomeIcon icon="envelope"/>
									</InputGroup.Text>
								</InputGroup.Prepend>
								<FormControl
									id="userEmail"
									onChange={handleChange}
									onBlur={handleBlur}
									placeholder="Email"
									type="email"
									value={values.signingEmail}
								/>
							</InputGroup>
							{
								errors.userEmail && touched.userEmail && (
									<div className="alert alert-danger">
										{errors.signinEmail}
									</div>
								)
							}
						</Form.Group>
						<Form.Group>
							<Form.Label className="sr-only">Password</Form.Label>
							<InputGroup>
								<InputGroup.Prepend>
									<InputGroup.Text>
										<FontAwesomeIcon icon="key"/>
									</InputGroup.Text>
								</InputGroup.Prepend>
								<FormControl
									id="userHash"
									onChange={handleChange}
									onBlur={handleBlur}
									type="password"
									placeholder="Password"
									value={values.userHash}
								/>
							</InputGroup>
							{
								errors.userHash && touched.userHash && (
									<div className="alert alert-danger">
										{errors.userHash}
									</div>
								)
							}
						</Form.Group>
						<Form.Group className="text-md-right">
							<Button variant="primary" type="submit" onClick={e => {console.log(e, props)}}>
								<FontAwesomeIcon icon="sign-in-alt"/>&nbsp;Sign In
							</Button>
						</Form.Group>
					</Form>
					{status && (<div className={status.type}>{status.message}</div> && console.log(status))}
					{/*<FormDebugger {...props}/>*/}

						<div className="my-2">
							<span className="font-weight-light font-italic">Don't have an account?&nbsp;</span>
							<Link to="/signup">Sign Up</Link>
						</div>
				</Card.Body>
			</Card>

		</>
	)
};