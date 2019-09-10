import React from "react";

import {FormDebugger} from "../../shared/components/FormDebugger";

import Form from "react-bootstrap/Form";
import InputGroup from "react-bootstrap/InputGroup";
import FormControl from "react-bootstrap/es/FormControl";
import Button from "react-bootstrap/Button";
import Card from "react-bootstrap/Card";

export const CommentFormContent = (props) => {


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

			<Card bg="light" className="mb-3">
				<Card.Body>
					<Form onSubmit={handleSubmit}>

						<Form.Group>
							<Form.Label className="sr-only">Comment Content</Form.Label>
							<InputGroup>
								<FormControl
									id="commentContent"
									as="textarea"
									rows="5"
									onChange={handleChange}
									onBlur={handleBlur}
									placeholder="Your opinion here..."
									value={values.commentContent}
								/>
							</InputGroup>
							{
								errors.commentContent && touched.commentContent && (
									<div className="alert alert-danger">
										{errors.commentContent}
									</div>
								)
							}
						</Form.Group>

						<Form.Group>
							<Button variant="primary" type="submit">Post!</Button>
						</Form.Group>
					</Form>

					{/*for testing purposes only*/}
					{/*<FormDebugger {...props}/>*/}

				</Card.Body>
			</Card>

			{status && (<div className={status.type}>{status.message}</div>)}

		</>
	)
};