import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {FormDebugger} from "../../shared/components/FormDebugger";
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
				{/*controlId must match what is defined by the initialValues object*/}
				<div className="form-group">
					<label htmlFor="userHash">Password</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="key">

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
					{errors.userHash && touched.userHash && (
						<div className="alert alert-danger">{errors.userHashConfirm}</div>

					)}
				</div>

				<div className="form-group">
					<label htmlFor="userName">User Name</label>
					<div className="input-group">
						<div className="input-group-prepend">
							<div className="input-group-text">
								<FontAwesomeIcon icon="dove"/>

							</div>
					</div>
					<input
								className="form-control"
								id="userName"
								type="text"
								value={values.userName}
								placeholder="UserName"
								onChange={handleChange}
								onBlur={handleBlur}

					/>
				</div>
					{
							errors.userName && touched.userName && (
								<div className="alert alert-danger">
									{errors.userName}
							)
					}
								</div>

					}
				</div>
				<div className="form-group">
					<button className="btn btn btn-danger mb-2" type="submit"Submit</button>
				<button
							className="btn btn-danger mb-2"
							onClick={handleReset}
							disabled={!dirty || isSubmitting}
					>Reset
				</button>
			</div>

					<FormDebugger {...props} />
				</form>
				{console.log(
					submitStatus
				)}
				{
					submitStatus && (<div className={submitStatus.type}>{submitStatus.message}</div>)
				}
				</>


		)
};
