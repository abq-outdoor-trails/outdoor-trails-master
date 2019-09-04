import React, {useState} from "react";
import {httpConfig} from "../../shared/utils/http-config";
import * as Yup from "yup";
import {Formik} from "formik";

import {CommentFormContent} from "./CommentFormContent";

export const CommentForm = () => {

	const [status, setStatus] = useState(null);

	const comment = {
		commentContent: ""
	};

	const validator = Yup.object().shape({
		commentContent: Yup.string()
			.required("You can post something here!")
			.max(2000, "2000 characters max.")
	});

	const submitComment = (values, {resetForm, setStatus}) => {
		//grab jwt token to pass in headers on comment request
		const headers = {
			'X-JWT-TOKEN': window.localStorage.getItem("jwt-token")
		};

		httpConfig.post("/apis/comment/", values, {
			headers: headers})
			.then(reply => {
				let{message, type} = reply;
				setStatus({message, type});
				if(reply.status === 200) {
					resetForm();
					setStatus({message, type});
					setTimeout(() => {
						window.location.reload ();
					}, 1500);
				}
			});
	};

	return (
		<>
			<Formik
				initialValues={comment}
				onSubmit={submitComment}
				validationSchema={validator}
				>
				{CommentFormContent}
			</Formik>
		</>
	)
};
