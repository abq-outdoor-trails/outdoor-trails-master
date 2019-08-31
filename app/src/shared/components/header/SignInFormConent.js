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
							<div className="form-group">
								<label htmlFor="userHash">Password</label>
								<div className="input-group">
									<div className="input-group-prepend">
										<div className="input-group-text">
											<FontAwesomeIcon icon="key"/>
										</div>
									</div>
									<input
												id="userHash"
												className="form-control"
												type="password"
												placeholder="Password"
												value={values.userHash}
												onChange={handleChange}
												onBlur={handleBlur}
											/>
								</div>

								<div className="form-group">
									<button className="btn btn-primary mb-2" type="submit">Submit</button>
									<button
												className="btn btn-danger mb-2"
												onClick={handleReset}
												disabled={!dirty || isSubmitting}
											>Reset
									</button>
								</div>
								<FormDebugger {...props}/>
							</form>
							{status && (<div className={status.type}->{status.message}</div>)}
					</>



		)
};