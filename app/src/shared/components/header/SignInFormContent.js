import React from "react";
import {Link} from "react-router-dom";


import {FormDebugger} from "../../components/FormDebugger";

import Card from "react-bootstrap/Card";
import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import FormControl from "react-bootstrap/es/FormControl";
import Button from "react-bootstrap/Button";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";


/* the call to grab XSRF from the new API. */
const getXsrf = () => {
	httpConfig.get("/apis/xsrf/")
		.then(reply => {
			if(reply.status === 200) {
				console.log(reply);
			}
		});
};

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
									<div ClassName="alert alert-danger">
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
							<Button variant="primary" type="submit">
								<FontAwesomeIcon icon="sign-in-alt"/>&nbsp;Sign In
							</Button>
						</Form.Group>
					</Form>
					<FormDebugger {...props}/>

						<div ClassName="my-2">
							<span className="font-weight-light font-italic">Don't have an account?&nbsp;</span>
							<Link to="...pages/signUp/SignUpForm.js">Sign Up</Link>
						</div>
				</Card.Body>
				{/* grab XSRF on click! Remove me when finsihed testing! */}
				<button onClick={getXsrf}>get xsrf</button>
			</Card>

		</>
	)
};