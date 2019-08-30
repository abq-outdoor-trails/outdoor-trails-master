import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {FormDebugger} from "../../FormDebugger";
import React from "react";

export const SignUpFormContent = (props) => {
	const {
				submitStatus,
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
			<form onSubmit={handleSubmit}>
				{/*controlId must match what is passed to the initialValues prop*/}
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
				




			</>
	)
