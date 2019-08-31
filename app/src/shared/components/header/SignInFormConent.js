import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {FormDebugger} from "../../FormDebugger";
import React from "react";

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
						<form onsSubmit={handleSubmit}>
							{/*controlId must match what is passed to the intialValues prop*/}
							<div className="form-group">
								<label htmlFor="userEmail">Email Address</label>
								<div className="input-group">
									<div className="input-group-prepend">
										<div className="input-group-text">
											<FontAwesomeIcon icon="envelope"/>
										</div>
									</div>
									<input
												className="form-control"
												id="userEmail"
												type="email"
												value={values.userEmail}
												placeholder="Enter email"
												onChange={handleChange}
												onBlur={handleBlur}

									/>
								</div>
								{
										errors.userEmail && touched.userEmail && (
											<div className="alert alert-danger">
												{errors.userEmail}
											</div>
										)
								}
							</div>
							{/*controlId must match what is defined by the intialValues object*/}
							
								}
								}

		)
}